<?php 
// Include the header file
include 'header.php'; 

// Include the database connection
include './config/db.php';

// Check if the user is logged in
if(!isset($_SESSION['user'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}

// Check if the cart is empty
if(empty($_SESSION['cart'])) {
    echo "<div class='container'><p class='text-danger'>Your cart is empty. Please add items to your cart before checking out.</p></div>";
} else {
    // Calculate the total cost of the items in the cart
    $totalCost = 0;
    foreach($_SESSION['cart'] as $product) {
        $totalCost += $product['price'] * $product['quantity'];
    }

    // Insert order details into the database
    $userId = $_SESSION['user']['id']; // Assuming user ID is stored in session
    $orderDate = date('Y-m-d H:i:s'); // Get current date and time
    
    // Fetch user's address from session or database
    // Assuming address is stored in session
    $address = isset($_SESSION['user']['address']) ? $_SESSION['user']['address'] : '';

    // Check if the payment form is submitted
    if(isset($_POST['submit_payment'])) {
        $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

        // Prepare the SQL and process each item in the cart
        foreach($_SESSION['cart'] as $productId => $product) {
            $quantity = $product['quantity'];
            $pid = $productId; // Use the product ID from the loop
            $approved = 0; // Assuming order needs approval

            // Insert order details into the database
            $orderSql = "INSERT INTO orders (user_id, total_cost, quantity, approved, payment_method, address, orderdate, product_id) VALUES ('$userId', '$totalCost', '$quantity', '$approved', '$payment_method', '$address', '$orderDate', '$pid')";
            
            // Execute the SQL query for each item
            if(mysqli_query($conn, $orderSql)) {
                // Get the order ID of the newly inserted order
                $orderId = mysqli_insert_id($conn);

                // Process payment based on the selected payment method
                if($payment_method == "UPI") {
                    // Handle UPI payment
                    // Generate QR code and store payment details
                    // Ask for delivery address and contact number
                } elseif($payment_method == "Debit Card") {
                    // Handle Debit Card payment
                    // Ask for card details and store payment details
                    // Ask for delivery address and contact number
                } elseif($payment_method == "COD") {
                    // Handle Cash on Delivery
                    // Ask for delivery address and contact number
                    // Store payment details as COD
                }
            } else {
                // If one of the queries fails, display error message and stop further execution
                echo "<div class='container'><p class='text-danger'>Failed to place order. Please try again.</p></div>";
                exit(); // Stop further execution
            }
        }

        // After processing all items, clear the cart and display success message
        unset($_SESSION['cart']);
        echo "<div class='container'><p class='text-success'>Your order has been placed successfully.</p></div>";
    }
}
?>

<div class="container">
    <h1>Checkout</h1>
    <div class="row">
        <div class="col-md-6">
            <h2>Payment Details</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="payment_method">Select Payment Method:</label>
                    <select class="form-control" id="payment_method" name="payment_method" required>
                        <option value="">Select Payment Method</option>
                        <option value="UPI">UPI</option>
                        <option value="Debit Card">Debit Card</option>
                        <option value="COD">Cash on Delivery</option>
                    </select>
                </div>
                <!-- Add other payment fields as needed -->
                <button type="submit" class="btn btn-primary" name="submit_payment">Submit Payment</button>
            </form>
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
                    <p class="card-text">Total Price: ₹<?php echo number_format($totalPrice, 2); ?></p>
                    <a href="cart.php?action=clear" class="btn btn-danger">Clear Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
