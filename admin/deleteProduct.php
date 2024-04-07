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

    // Delete the product from the database based on ID
    $sql = "DELETE FROM products WHERE id = '$id'";
    if(mysqli_query($conn, $sql)) {
        // Redirect back to the manage products page after deletion
        header("Location: manage_products.php");
        exit();
    } else {
        // Error handling if deletion fails
        echo "Error deleting product: " . mysqli_error($conn);
    }
}
?>
