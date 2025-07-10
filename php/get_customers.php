<?php
// Database connection
$conn = new mysqli("localhost", "username", "password", "database_name");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customers
$sql = "SELECT id, name, email, phone FROM customers";
$result = $conn->query($sql);

$customers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($customers);

$conn->close();
?>
