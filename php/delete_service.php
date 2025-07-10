<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SOEN287";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete the service
$id = $_GET['id'];
$sql = $conn->prepare("DELETE FROM services WHERE id = ?");
$sql->bind_param("i", $id);

if ($sql->execute()) {
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Service Deleted</title>
        <style>
            body {
                font-family: 'Montserrat', sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f9f9f9;
                color: #333;
                text-align: center;
            }
            .container {
                max-width: 500px;
                margin: 100px auto;
                background: #fff;
                padding: 20px 30px;
                border-radius: 8px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: #ff4f18;
                font-size: 2rem;
            }
            p {
                font-size: 1.2rem;
                margin: 20px 0;
            }
            .button {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #ff4f18;
                color: #fff;
                text-decoration: none;
                font-size: 1rem;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }
            .button:hover {
                background-color: #e04816;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Service Deleted Successfully!</h1>
            <p>The service has been removed from the database.</p>
            <a href='service_table.html' class='button'>Go Back to Service List</a>
        </div>
    </body>
    </html>
    ";
} else {
    echo "Error deleting service: " . $conn->error;
}

$conn->close();
?>
