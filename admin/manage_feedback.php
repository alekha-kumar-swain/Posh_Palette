<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login/signup.php");
    exit();
}
// Include database connection file
include '../config/db.php';

// Fetch feedback from the database
$sql = "SELECT * FROM feedback LIMIT 3"; // Limit to 3 feedback entries
$result = mysqli_query($conn, $sql);

// Check if there is any feedback
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<h2>Product ID: " . $row['product_id'] . "</h2>";
        echo "<p>Message: " . $row['message'] . "</p>";
        echo "<p>Rating: " . $row['rating'] . "</p>";
        // Add more feedback details as needed
        echo "</div>";
    }
} else {
    echo "No feedback found";
}

// Close database connection
mysqli_close($conn);
?>
