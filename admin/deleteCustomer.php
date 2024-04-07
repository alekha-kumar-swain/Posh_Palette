<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Include database connection file
include '../config/db.php';

// Check if ID parameter is provided
if(isset($_GET['id'])) {
    // Get the ID from the URL
    $id = $_GET['id'];

    // Perform the delete operation
    $sql = "DELETE FROM users WHERE id = '$id'";
    mysqli_query($conn, $sql);

    // Redirect back to the manage_customers.php page after deletion
    header("Location: manage_customers.php");
    exit();
}
?>
