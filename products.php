<?php include 'header.php'; ?>
<?php include './config/db.php'; ?>

<div class="container">
    <h1>Our Products</h1>
    <!-- Search box -->
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search products..." id="searchInput">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button" id="searchButton"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>
    <!-- Filter options -->
    <div class="form-group">
        <label for="sortSelect">Sort by Price:</label>
        <select class="form-control" id="sortSelect">
            <option selected>SELECT</option>
            <option value="lowToHigh">Low to High</option>
            <option value="highToLow">High to Low</option>
        </select>
    </div>
    <!-- Display product listings here -->
    <div class="row" id="productList">
        <?php
        // Fetch products from the database
        $sql = "SELECT * FROM products";
        
        // Check if sorting option is selected
        if(isset($_GET['sort'])) {
            $sortOption = $_GET['sort'];
            if($sortOption == 'lowToHigh') {
                $sql .= " ORDER BY Price ASC";
            } elseif($sortOption == 'highToLow') {
                $sql .= " ORDER BY Price DESC";
            }
        }

        $result = mysqli_query($conn, $sql);

        // Check if there are any products
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="col-md-4 productItem">
                    <div class="card productcard">
                        <img src="<?php echo $row['ProductLink']; ?>" class="card-img-top" alt="<?php echo $row['ProductName']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['ProductName']; ?></h5>
                            <p class="card-text"><?php echo $row['Description']; ?></p>
                            <p class="card-text"><strong>Price: ₹<?php echo $row['Price']; ?></strong></p>
                            <a href="product_details.php?id=<?php echo $row['ProductNumber']; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "No products found";
        }

        // Close database connection
        mysqli_close($conn);
        ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchButton').click(function() {
            var searchQuery = $('#searchInput').val().toLowerCase();
            $('.productItem').each(function() {
                var productName = $(this).find('.card-title').text().toLowerCase();
                var productDescription = $(this).find('.card-text').text().toLowerCase();
                if (productName.includes(searchQuery) || productDescription.includes(searchQuery)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $('#sortSelect').change(function() {
            var selectedOption = $(this).val();
            window.location.href = 'products.php?sort=' + selectedOption;
        });
    });
</script>

<?php include 'footer.php'; ?>
