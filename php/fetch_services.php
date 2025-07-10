<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SOEN287";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]));
}

$sql = "SELECT * FROM services";
$result = $conn->query($sql);

$services = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode(["status" => "success", "data" => $services]);

$conn->close();
?>
