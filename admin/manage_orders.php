<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
// Include database connection file
include '../config/db.php';

// Fetch orders from the database
$sql = "SELECT orders.*, users.username, products.ProductName FROM orders
        LEFT JOIN users ON orders.user_id = users.id
        LEFT JOIN products ON orders.product_id = products.id
       ";

$result = mysqli_query($conn, $sql);
?>
<?php  include 'header.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Recent Orders</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Username</th>
                    <th>Product Name</th>
                    <th>Total Cost</th>
                    <th>Quantity</th>
                    <th>Payment Method</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Admin's Manage Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any orders
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['orderdate']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['ProductName']; ?></td>
                            <td>₹<?php echo $row['total_cost']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['payment_method']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['approved']; ?></td>
                            <td>
                                <form action="approve_order.php" method="post" style="display: inline;">
                                    <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-outline-success" name="approve">
                                        <i class="fa-solid fa-check" style="color: #08e72e;"></i>
                                    </button>
                                    <button type="submit" class="btn btn-outline-warning" name="reject">
                                        <i class="fa-solid fa-xmark" style="color: #f50a16;"></i>
                                    </button>
                                </form>
                                <form action="remove_order.php" method="post" style="display: inline;">
                                    <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-outline-danger" name="remove">
                                        <i class="fa-solid fa-trash-can" style="color: #f4bf45;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='9'>No orders found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
