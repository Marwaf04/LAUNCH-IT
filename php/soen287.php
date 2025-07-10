<?php

// Your CSS styling
echo '<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Full height of the viewport */
        margin: 0; /* Remove default margin */
        font-family: Arial, sans-serif;
    }
    .container {
        text-align: center; /* Center text inside the container */
    }
    .message {
        color: #FF4F18;
        font-size: 18px;
        margin-bottom: 20px;
    }
    .btn {
        background-color: #FF4F18;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }
    .btn:hover {
        background-color: #E74615;
    }
</style>';

// Retrieve form data
$Type = $_POST["Request-Service"];
$Date = $_POST["date"];
$Requirements = $_POST["requirements"];

// Database connection details
$host = "localhost"; 
$dbname = "SOEN287";
$username = "root";
$password = "";

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare and execute the SQL statement
$sql = "INSERT INTO Confirm(ServiceType, Date, Requirements) VALUES (?, ?, ?)";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sss", $Type, $Date, $Requirements);
mysqli_stmt_execute($stmt);

// Display success messages centered in the page
echo '<div class="container">';
echo '<div class="message">Connection successful.<br>';
echo 'Thank you for your order. Service added successfully.<br></div>';
echo '<button class="btn" onclick="window.location.href=\'client_dashboard.php\'">Go to Dashboard</button>';
echo '</div>';

?>
