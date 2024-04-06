<?php 
// Include the header file
include 'header.php'; 

// Include the database connection
include './config/db.php';

// Check if the product ID is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $productId = mysqli_real_escape_string($conn, $_GET['id']);

    // Query to fetch product details based on the product ID
    $sql = "SELECT * FROM products WHERE ProductNumber = '$productId'";
    $result = mysqli_query($conn, $sql);

    // Check if the product exists
    if(mysqli_num_rows($result) > 0) {
        // Fetch product details
        $product = mysqli_fetch_assoc($result);
?>

<div class="container">
    <h1>Product Details</h1>
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo $product['ProductLink']; ?>" class="img-fluid" alt="<?php echo $product['ProductName']; ?>">
        </div>
        <div class="col-md-6">
            <h2><?php echo $product['ProductName']; ?></h2>
            <b> <?php echo $product['Description']; ?></b>
            <p> Description:<?php echo $product['Description_Long']; ?></p>
            <p>Brand: <?php echo $product['ProductBrand']; ?></p>
            <p>Net Quantity: <?php echo $product['NetQuantity']; ?></p>
            <p>Used For: <?php echo $product['UsedFor']; ?></p>
            <p>Country of Origin: <?php echo $product['Country_of_Origin']; ?></p>
            <p>Price: $<?php echo $product['Price']; ?></p>
            <form method="post" action="cart.php?action=add&id=<?php echo $product['ProductNumber']; ?>">
                <input type="hidden" name="id" value="<?php echo $product['ProductNumber']; ?>">
                <input type="hidden" name="name" value="<?php echo $product['ProductName']; ?>">
                <input type="hidden" name="price" value="<?php echo $product['Price']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
    </div>
</div>

<?php
    } else {
        echo "<div class='container'><p class='text-danger'>Product not found.</p></div>";
    }
} else {
    echo "<div class='container'><p class='text-danger'>Product ID not provided.</p></div>";
}

// Include the footer file
include 'footer.php'; 
?>
