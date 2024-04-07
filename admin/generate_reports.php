<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login/signup.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Reports</title>
</head>
<body>
    <h2>Generate Reports</h2>
    <!-- Add report generation functionality here -->
</body>
</html>
