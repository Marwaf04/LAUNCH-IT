<?php
// Include database connection
require_once 'dbConnect.php';
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = [];
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $emailToUpdate = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $newName = trim($_POST['name']);

    // Validate inputs
    if (empty($emailToUpdate) || !filter_var($emailToUpdate, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required.';
    }
    if (empty($newName)) {
        $errors[] = 'Name is required.';
    }

    // Update the database if no errors
    if (empty($errors)) {
        try {
            // Check if database connection is working
            if (!$pdo) {
                throw new PDOException('Database connection failed.');
            }

            // Prepare and execute the update query
            $stmt = $pdo->prepare("UPDATE users SET name = :name, updated_at = NOW() WHERE email = :email");
            $result = $stmt->execute([
                ':name' => $newName,
                ':email' => $emailToUpdate
            ]);

            if ($result && $stmt->rowCount() > 0) {
                $success = 'Name updated successfully.';
            } else {
                $errors[] = 'Failed to update the name. Please check the email.';
            }
        } catch (PDOException $e) {
            $errors[] = 'Database error: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/editProfile.css">
</head>

<body>
    <div class="container">
        <h1>Edit Profile</h1>

        <!-- Display success or error messages -->
        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="error-main"><?php echo htmlspecialchars($error); ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Profile Edit Form -->
        <form method="POST" action="">
            <!-- Email Input -->
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Enter the email" required>
            </div>

            <!-- Name Input -->
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="Enter the name" required>
            </div>

            <!-- Submit Button -->
            <input type="submit" class="btn" value="Update">
        </form>
    </div>
</body>

</html>
