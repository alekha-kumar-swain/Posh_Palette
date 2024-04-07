<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Include database connection file
include '../config/db.php';

// Check if the form is submitted and the order ID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    // Get the order ID from the form
    $order_id = $_POST['order_id'];

    // Check if the approve button is clicked
    if (isset($_POST['approve'])) {
        // Process the approval
        $sql = "UPDATE orders SET approved = 'YES' WHERE id = '$order_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Order approved successfully.";
            header("Location: manage_orders.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['reject'])) {
        // Process the rejection
        $sql = "UPDATE orders SET approved = 'NO' WHERE id = '$order_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Order rejected successfully.";
            header("Location: manage_orders.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Neither approve nor reject button is clicked
        echo "Invalid action.";
    }
} else {
    // Order ID is not provided or form is not submitted
    echo "Invalid request.";
}

// Close database connection
mysqli_close($conn);
?>
