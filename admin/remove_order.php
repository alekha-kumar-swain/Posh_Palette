<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove'])) {
    // Include database connection file
    include '../config/db.php';

    // Get the order ID from the form submission
    $order_id = $_POST['order_id'];

    // Prepare a DELETE statement to remove the order from the database
    $sql = "DELETE FROM orders WHERE id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "i", $order_id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Order successfully removed
            header("Location: manage_orders.php");
            exit();
        } else {
            // Error occurred while executing the statement
            echo "Error: Unable to remove the order.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        // Error occurred while preparing the statement
        echo "Error: Unable to prepare the SQL statement.";
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // If the request method is not POST or 'remove' parameter is not set
    header("Location: orders.php");
    exit();
}
?>
