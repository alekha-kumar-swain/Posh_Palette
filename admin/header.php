<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start session if not already started
}

// Check if the user is logged in
$loggedIn = isset($_SESSION['admin']);

// Set the welcome message and login/logout link
if ($loggedIn) {
    $welcomeMessage = "Welcome, {$_SESSION['admin']['username']}";
    $loginLogoutLink = "logout.php' style='color:red;'";
    $linkText = "Logout";
} else {
    $welcomeMessage = "Welcome, Guest";
    $loginLogoutLink = "login.php";
    $linkText = "Admin Login";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posh Palette</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <nav class="navbar admin navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="../images/admin-logo.png" alt="Posh Palette Logo" width="180" height="80">

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="navbar-text"><b><?php echo $welcomeMessage; ?></b></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href='<?php echo $loginLogoutLink; ?>'><b ><?php echo $linkText; ?></b></a>
                    </li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <hr>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
