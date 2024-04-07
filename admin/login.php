<?php
session_start();
include '../config/db.php';

// Check if the user is already logged in, redirect to index.php
if(isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

// Initialize variables
$error = '';

// Check if form is submitted
if(isset($_POST['login'])) {
    // Sanitize form data
    $email = $_POST['email'];
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check user credentials
    $sql = "SELECT * FROM admins WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if($result) {
        // If user exists, verify password and set session
        if(mysqli_num_rows($result) == 1) {
            $admin = mysqli_fetch_assoc($result);
            if(password_verify($password, $admin['password'])) {
                // Store user information in session
                $_SESSION['admin'] = [
                    'id' => $admin['id'],
                    'username' => $admin['username'], 
                    'email' => $admin['email']
                ];
                // Redirect to index.php or any other page
                header("Location: index.php");
                exit;
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "User with this email does not exist.";
        }
    } else {
        // Error in executing the query
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Posh Palette</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="main">
        <div class="container custom-container">
            <div class="row">
                <div class="col-md-6">               
                    <img src="../images/5.jpg" alt="Another Image" class="img-fluid custom-image">
                </div>
                <!-- Image on the left, Content on the right for desktop -->
                <div class="col-md-6">
                    <h2 class="mb-4">Login</h2>
                    <?php if(!empty($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                        <a href="signup.php" class="btn btn-link">Sign Up</a>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
