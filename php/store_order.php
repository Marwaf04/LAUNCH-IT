<?php
session_start();
include 'dbConnect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$cartItems = $data['cartItems'];
$date = date("Y-m-d H:i:s");
$totalAmount = 0;

// Validate the cart data
if (empty($cartItems)) {
    echo json_encode(["success" => false, "message" => "Cart is empty."]);
    exit();
}

// Calculate the total amount and prepare services
$serviceTypes = [];
foreach ($cartItems as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
    $serviceTypes[] = $item['name'] . " x" . $item['quantity'];
}
$serviceTypeString = implode(", ", $serviceTypes);

try {
    // Insert the order into the Confirm table
    $stmt = $conn->prepare("INSERT INTO Confirm (ServiceType, Date, Requirements, amount, Status) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$serviceTypeString, $date, "N/A", $totalAmount, 0]);

    echo json_encode(["success" => true, "message" => "Order saved successfully!"]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
?>