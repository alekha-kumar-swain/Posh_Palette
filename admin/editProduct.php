<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Include database connection file
include '../config/db.php';

// Check if ID parameter is provided
if(isset($_GET['id'])) {
    // Get the ID from the URL
    $id = $_GET['id'];

    // Fetch product data based on ID from the database
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result); // Fetch the product data

    // If form is submitted, update the product data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productName = $_POST['productName'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $productBrand = $_POST['productBrand'];
        $countryOfOrigin = $_POST['countryOfOrigin'];
        $usedFor = $_POST['usedFor'];
        $netQuantity = $_POST['netQuantity'];
        $descriptionLong = $_POST['descriptionLong'];
        $productLink = $_POST['productLink'];

        // Update query
        $updateSql = "UPDATE products SET 
            ProductName='$productName', 
            Description='$description', 
            Price='$price', 
            ProductBrand='$productBrand', 
            Country_of_Origin='$countryOfOrigin', 
            UsedFor='$usedFor', 
            NetQuantity='$netQuantity', 
            Description_Long='$descriptionLong', 
            ProductLink='$productLink' 
            WHERE id='$id'";

        if (mysqli_query($conn, $updateSql)) {
            echo '<div class="alert alert-success" role="alert">Product updated successfully</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error updating product: ' . mysqli_error($conn) . '</div>';
        }
    }
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Product</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" value="<?php echo $row['ProductName']; ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"><?php echo $row['Description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['Price']; ?>">
            </div>
            <div class="form-group">
                <label for="productBrand">Product Brand</label>
                <input type="text" class="form-control" id="productBrand" name="productBrand" value="<?php echo $row['ProductBrand']; ?>">
            </div>
            <div class="form-group">
                <label for="countryOfOrigin">Country of Origin</label>
                <input type="text" class="form-control" id="countryOfOrigin" name="countryOfOrigin" value="<?php echo $row['Country_of_Origin']; ?>">
            </div>
            <div class="form-group">
                <label for="usedFor">Used For</label>
                <input type="text" class="form-control" id="usedFor" name="usedFor" value="<?php echo $row['UsedFor']; ?>">
            </div>
            <div class="form-group">
                <label for="netQuantity">Net Quantity</label>
                <input type="text" class="form-control" id="netQuantity" name="netQuantity" value="<?php echo $row['NetQuantity']; ?>">
            </div>
            <div class="form-group">
                <label for="descriptionLong">Description Long</label>
                <textarea class="form-control" id="descriptionLong" name="descriptionLong"><?php echo $row['Description_Long']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="productLink">Image Link</label>
                <input type="text" class="form-control" id="productLink" name="productLink" value="<?php echo $row['ProductLink']; ?>">
            </div>
            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
