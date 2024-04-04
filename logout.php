<?php
// Start session
session_start();

// Destroy session and redirect to login.php
session_destroy();
header("Location: login.php");
exit;
?>
