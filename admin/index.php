<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Welcome to Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card admincard">
                <img src="../images/6.webp" class="card-img-top" alt="Manage Products">
                    <div class="card-body">
                        <h5 class="card-title">Manage Products</h5>
                        <p class="card-text">Click here to manage products.</p>
                        <a href="manage_products.php" class="btn btn-primary">Go to Products</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card admincard">
                    <img src="../images/7.webp" class="card-img-top" alt="Manage Products">
                    <div class="card-body">
                        <h5 class="card-title">Manage Orders</h5>
                        <p class="card-text">Click here to manage orders.</p>
                        <a href="manage_orders.php" class="btn btn-primary">Go to Orders</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card admincard">
                    <img src="../images/8.jpg" class="card-img-top" alt="Manage Products">
                    <div class="card-body">
                        <h5 class="card-title">Manage Customers</h5>
                        <p class="card-text" style="font-size: 90%;">Click here to manage customers.</p>
                        <a href="manage_customers.php" class="btn btn-primary">Go to Customers</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card admincard">
                    <img src="../images/9.jpeg" class="card-img-top" alt="Manage Products">
                    <div class="card-body">
                        <h5 class="card-title">Manage Feedback</h5>
                        <p class="card-text">Click here to manage feedback.</p>
                        <a href="manage_feedback.php" class="btn btn-primary">Go to Feedback</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card admincard">
                    <img src="../images/10.webp" class="card-img-top" alt="Manage Products">
                    <div class="card-body">
                        <h5 class="card-title">Generate Reports</h5>
                        <p class="card-text">Click here to generate reports.</p>
                        <a href="generate_reports.php" class="btn btn-primary">Generate Reports</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card admincard">
                    <img src="../images/11.jpeg" class="card-img-top" alt="Manage Products">
                    <div class="card-body">
                        <h5 class="card-title">Logout</h5>
                        <p class="card-text">Click here to logout.</p>
                        <a href="logout.php" class="btn btn-primary" style="color:white;background-color:red;">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>
