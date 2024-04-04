<?php include 'header.php'; ?>

<div class="container">
    <h1>Shopping Cart</h1>
    <!-- Display cart items and total -->
    <div class="row">
        <div class="col-md-8">
            <!-- Display cart items here -->
            <p>Your cart is empty.</p>
        </div>
        <div class="col-md-4">
            <!-- Display total and checkout button here -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total</h5>
                    <p class="card-text">Total Price: $X.XX</p>
                    <a href="checkout.php" class="btn btn-primary">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
