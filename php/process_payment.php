<?php

$host = 'localhost';
$dbname = 'SOEN287';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed : ' . $e->getMessage()]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['cartDetails'])) {
    try {

        $stmt = $conn->prepare("
            INSERT INTO InvoiceDetails (service, price, quantity, total)
            VALUES (:service, :price, :quantity, :total)
        ");

        foreach ($data['cartDetails'] as $item) {
            $stmt->execute([
                ':service' => $item['name'],
                ':price' => $item['price'],
                ':quantity' => $item['quantity'],
                ':total' => $item['price'] * $item['quantity']
            ]);
        }

        echo json_encode(['status' => 'success', 'message' => 'The basket details have been successfully saved!']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Data insertion failure:' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data.']);
}
?>