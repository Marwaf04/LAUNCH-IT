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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['serviceName'];
    $price = $_POST['servicePrice'];
    $description = $_POST['serviceDescription'];
    $image = $_FILES['serviceImage']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    // Validate and upload file
    if (!move_uploaded_file($_FILES['serviceImage']['tmp_name'], $target_file)) {
        die("Failed to upload image. Check folder permissions.");
    }

    // Insert service into the database
    $sql = $conn->prepare("INSERT INTO services (name, price, description, image_path) VALUES (?, ?, ?, ?)");
    $sql->bind_param("sdss", $name, $price, $description, $target_file);

    if ($sql->execute()) {
       
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Service Added</title>
            <style>
                body {
                    font-family: 'Montserrat', sans-serif;
                    text-align: center;
                    background-color: #f9f9f9;
                    color: #333;
                }
                .container {
                    margin: 50px auto;
                    padding: 20px;
                    background: #fff;
                    width: 90%;
                    max-width: 500px;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #ff4f18;
                }
                p {
                    font-size: 1.2rem;
                }
                .button {
                    margin-top: 20px;
                    padding: 10px 20px;
                    background-color: #ff4f18;
                    color: #fff;
                    text-decoration: none;
                    font-size: 1rem;
                    border-radius: 5px;
                    display: inline-block;
                    transition: background-color 0.3s ease;
                }
                .button:hover {
                    background-color: #e04816;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Service Added Successfully!</h1>
                <p>The new service has been added to the database.</p>
                <a href='admin_dashboard.html' class='button'>Go Back to Dashboard</a>
            </div>
        </body>
        </html>
        ";
    } else {
        echo "Error: " . $sql->error;
    }

    $sql->close();
}

$conn->close();
?>
