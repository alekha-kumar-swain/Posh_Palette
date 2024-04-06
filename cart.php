<?php
session_start();

// Include the database connection
include './config/db.php';

// Check if action is set
if(isset($_GET['action'])){
    // Check action type
    switch($_GET['action']){
        case 'add':
            if(isset($_POST['quantity']) && $_POST['quantity'] > 0){
                // Sanitize input to prevent SQL injection
                $productId = mysqli_real_escape_string($conn, $_GET['id']);
                $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

                // Check if product already exists in the cart
                if(isset($_SESSION['cart'][$productId])){
                    $_SESSION['cart'][$productId]['quantity'] += $quantity;
                } else {
                    // Query to fetch product details based on the product ID
                    $sql = "SELECT * FROM products WHERE ProductNumber = '$productId'";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_assoc($result);

                        // Add product to the cart
                        $_SESSION['cart'][$productId] = array(
                            'name' => $row['ProductName'],
                            'pid' => $row['ProductID'],
                            'price' => $row['Price'],
                            'quantity' => $quantity,
                            'image' => $row['ProductLink'] 
                        );
                    } else {
                        echo "<div class='container'><p class='text-danger'>Product not found.</p></div>";
                    }
                }
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
            break;
        case 'remove':
            // Remove product from the cart
            if(isset($_GET['id'])){
                $productId = mysqli_real_escape_string($conn, $_GET['id']);
                unset($_SESSION['cart'][$productId]);
            }
            header('Location: cart.php');
            exit();
            break;
        case 'clear':
            // Clear cart
            unset($_SESSION['cart']);
            header('Location: cart.php');
            exit();
            break;
        case 'update':
            // Update quantity of a product in the cart
            if(isset($_POST['quantity'])){
                foreach($_POST['quantity'] as $key => $value){
                    if($value <= 0){
                        unset($_SESSION['cart'][$key]);
                    } else {
                        $_SESSION['cart'][$key]['quantity'] = $value;
                    }
                }
            }
            header('Location: cart.php');
            exit();
            break;
        default:
            header('Location: cart.php');
            exit();
    }
}

// Include the header file
include 'header.php';
?>

<div class="container">
    <h1>Shopping Cart</h1>
    <!-- Display cart items and total -->
    <div class="row">
        <div class="col-md-8">
            <!-- Display cart items here -->
            <?php
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => $item) {
                    echo '<div class="card mb-3">';
                    echo '<div class="row no-gutters">';
                    echo '<div class="col-md-4">';
                    echo '<img src="' . $item['image'] . '" class="card-img" alt="' . $item['name'] . '">';
                    echo '</div>';
                    echo '<div class="col-md-8">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $item['name'] . '</h5>';
                    echo '<p class="card-text">Quantity: ' . $item['quantity'] . '</p>';
                    echo '<p class="card-text">Price: $' . number_format($item['price'] * $item['quantity'], 2) . '</p>';
                    echo '<a href="cart.php?action=remove&id=' . $key . '" class="btn btn-danger">Remove</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Your cart is empty.</p>';
            }
            ?>
        </div>
        <div class="col-md-4">
            <!-- Display total and checkout button here -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total</h5>
                    <?php
                    $totalPrice = 0;
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $item) {
                            $totalPrice += $item['price'] * $item['quantity'];
                        }
                    }
                    ?>
                    <p class="card-text">Total Price: $<?php echo number_format($totalPrice, 2); ?></p>
                    <a href="checkout.php" class="btn btn-primary">Checkout</a>
                    <a href="cart.php?action=clear" class="btn btn-danger">Clear Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
