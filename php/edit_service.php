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

// Fetch service details if ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = $conn->prepare("SELECT * FROM services WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
    } else {
        die("Service not found.");
    }
} else {
    die("No service ID provided.");
}

// Handle form submission for updating the service
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['serviceName'];
    $price = $_POST['servicePrice'];
    $description = $_POST['serviceDescription'];
    $image = $_FILES['serviceImage']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    // Check if a new image is uploaded
    if (!empty($image)) {
        if (!move_uploaded_file($_FILES['serviceImage']['tmp_name'], $target_file)) {
            die("Failed to upload image. Check folder permissions.");
        }
        // Update service with a new image
        $updateSql = $conn->prepare("UPDATE services SET name = ?, price = ?, description = ?, image_path = ? WHERE id = ?");
        $updateSql->bind_param("sdssi", $name, $price, $description, $target_file, $id);
    } else {
        // Update service without changing the image
        $updateSql = $conn->prepare("UPDATE services SET name = ?, price = ?, description = ? WHERE id = ?");
        $updateSql->bind_param("sdsi", $name, $price, $description, $id);
    }

    if ($updateSql->execute()) {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Service Updated</title>
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
                <h1>Service Updated Successfully!</h1>
                <a href='service_table.html' class='button'>Go Back to Service List</a>
            </div>
        </body>
        </html>
        ";
        exit;
    } else {
        die("Error updating service: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <link rel="stylesheet" href="css/add_service.css">
</head>

<body>
    <div class="container">
        <h1>Edit Service</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Service Name:</label>
            <input type="text" name="serviceName" value="<?php echo htmlspecialchars($service['name']); ?>" required>
            <label>Service Price:</label>
            <input type="number" name="servicePrice" value="<?php echo htmlspecialchars($service['price']); ?>" required>
            <label>Service Description:</label>
            <textarea name="serviceDescription" required><?php echo htmlspecialchars($service['description']); ?></textarea>
            <label>Upload New Image (Optional):</label>
            <input type="file" name="serviceImage" accept="image/*">
            <button type="submit" class="submit-button">Update Service</button>
        </form>
    </div>
</body>

</html>
