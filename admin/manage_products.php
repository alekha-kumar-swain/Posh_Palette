<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
// Include database connection file
include '../config/db.php';

// Fetch products from the database
$sql = "SELECT * FROM products "; 
$result = mysqli_query($conn, $sql);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize it
    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $productBrand = mysqli_real_escape_string($conn, $_POST['productBrand']);
    $countryOfOrigin = mysqli_real_escape_string($conn, $_POST['countryOfOrigin']);
    $usedFor = mysqli_real_escape_string($conn, $_POST['usedFor']);
    $netQuantity = mysqli_real_escape_string($conn, $_POST['netQuantity']);
    $descriptionLong = mysqli_real_escape_string($conn, $_POST['descriptionLong']);
    $productLink = mysqli_real_escape_string($conn, $_POST['productLink']);

    // Insert new product into the database
    $insertSql = "INSERT INTO products (ProductName, Description, Price, ProductBrand, Country_of_Origin, UsedFor, NetQuantity, Description_Long, ProductLink) 
                  VALUES ('$productName', '$description', '$price', '$productBrand', '$countryOfOrigin', '$usedFor', '$netQuantity', '$descriptionLong', '$productLink')";
    if (mysqli_query($conn, $insertSql)) {
        // Redirect to the same page to avoid resubmission
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $insertSql . "<br>" . mysqli_error($conn);
    }
}
?>
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <button class="btn btn-success mb-3" data-toggle="collapse" data-target="#addProductForm">Add New Product</button>
        <section class="popup">
            <div class="collapse" id="addProductForm">
                <h2>Add New Product</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="productBrand">Product Brand</label>
                        <input type="text" class="form-control" id="productBrand" name="productBrand" required>
                    </div>
                    <div class="form-group">
                        <label for="countryOfOrigin">Country of Origin</label>
                        <input type="text" class="form-control" id="countryOfOrigin" name="countryOfOrigin" required>
                    </div>
                    <div class="form-group">
                        <label for="usedFor">Used For</label>
                        <input type="text" class="form-control" id="usedFor" name="usedFor" required>
                    </div>
                    <div class="form-group">
                        <label for="netQuantity">Net Quantity</label>
                        <input type="text" class="form-control" id="netQuantity" name="netQuantity" required>
                    </div>
                    <div class="form-group">
                        <label for="descriptionLong">Description Long</label>
                        <textarea class="form-control" id="descriptionLong" name="descriptionLong" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productLink">Image Link</label>
                        <input type="text" class="form-control" id="productLink" name="productLink" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </section>
        <h1>Manage Products</h1>
        <div class="list-group">
            <?php
            // Check if there are any products
            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?php echo $row['ProductName']; ?></h5>
                            <small>Price: ₹<?php echo $row['Price']; ?></small>
                        </div>
                        <p class="mb-1"><b>Description: </b><?php echo $row['Description']; ?></p>
                        <p class="mb-1"><b>Brand:</b> <?php echo $row['ProductBrand']; ?></p>
                        <p class="mb-1"><b>Country of Origin:</b> <?php echo $row['Country_of_Origin']; ?></p>
                        <p class="mb-1"><b>Used For:</b> <?php echo $row['UsedFor']; ?></p>
                        <p class="mb-1"><b>Net Quantity:</b> <?php echo $row['NetQuantity']; ?></p>
                        <p class="mb-1"><b>Description Long:</b> <?php echo $row['Description_Long']; ?></p>
                        <img src="<?php echo $row['ProductLink']; ?>" alt="<?php echo $row['ProductName']; ?>" width="100" class="img-thumbnail">
                        <!-- Add more fields as needed -->
                        <div class="mt-2">
                            <a href="editProduct.php?id=<?php echo $row['id']; ?>" class="btn btn-primary mr-2">Edit</a>
                            <a href="deleteProduct.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </a>
            <?php
                }
            } else {
                echo "<p>No products found</p>";
            }
            ?>
        </div>
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
