<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
// Include database connection file
include '../config/db.php';

// Fetch customers from the database
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

?>
<?php  include 'header.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Manage Customers</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone Number</th>
                    <th colspan="2">Action</th>
                    <!-- Add more table headers for additional fields if needed -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any customers
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo '<td>'. $row['address'] .'</td>';
                        echo "<td>" . $row['phone_number'] . "</td>";
                        // Show edit button
                        echo "<td><a href='editCustomer.php?id=".$row['id']."' class='btn btn-primary'><i class='fa-solid fa-pen'></i></a></td>";
                        echo "<td><a href='deleteCustomer.php?id=".$row['id']."' class='btn btn-primary' style='background-color:white;'><i class='fa-solid fa-trash-can' style='color: #e60f45;'></i></a></td>";
                        echo "</tr>";

                    }
                } else {
                    echo "<tr><td colspan='4'>No customers found</td></tr>";
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
