<?php
session_start();
include 'dbConnect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// User information
$userId = $_SESSION['user_id'];
?>

<?php include 'cart.html'; ?>
