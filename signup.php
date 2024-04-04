<?php
// Include database connection
include './config/db.php';

// Check if form is submitted
if(isset($_POST['signup'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    // Query to insert new user
    $sql = "INSERT INTO users (username, email, password, address, phone_number) VALUES ('$username', '$email', '$password', '$address', '$phone_number')";
    mysqli_query($conn, $sql);
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Posh Palette</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Sign Up</h2>
        <form method="post">
            <div class="form-group">
                <label>name</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" name="address" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" name="phone_number" required>
            </div>
            <button type="submit" class="btn btn-primary" name="signup">Sign Up</button>
            <a href="login.php" class="btn btn-link">LogIn</a>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
