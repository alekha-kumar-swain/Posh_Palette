<?php include 'header.php'; ?>
<?php include 'slider.php'; ?>
<?php include './config/db.php'; ?>
<style>
  .image {
    display: block;
    width: 100%;
    height: auto;
  }

  .overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(250, 55, 66, 0.3);
    overflow: hidden;
    width: 100%;
    height: 0;
    transition: .5s ease;
  }

  .productcard:hover .overlay {
    height: 100%;
  }

  .text {
    color: white;
    font-size: 20px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }
</style>

<div class="container">
  <h1>Welcome to Posh Palette</h1>
  <p>Explore our curated selection of top-notch cosmetic brands!</p>
  <a href="products.php" class="btn btn-primary">Shop Now</a>
</div>
<hr>
<section class="main">
  <div class="container custom-container">
    <div class="row">
      <!-- Product having Just Herb Brands-->
      <?php
      // Fetch 3 random products from the database
      $sqlJustHerb = "SELECT * FROM products WHERE productBrand = 'Just Herbs' ORDER BY RAND() LIMIT 6";
      $resultJustHerb = mysqli_query($conn, $sqlJustHerb);
      // Check if there are any products
      if (mysqli_num_rows($resultJustHerb) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($resultJustHerb)) {
      ?>
          <div class="col-md-4 productItem">
            <div class="card productcard">
              <div class="container">
                <img src="<?php echo $row['ProductLink']; ?>" class="card-img-top image" alt="<?php echo $row['ProductName']; ?>">
                <div class="overlay">
                  <div class="text">
                    <h5 class="card-title"><?php echo substr($row['ProductName'], 0, 20); ?></h5>

                    <p class="card-text"><strong>Price: ₹<?php echo $row['Price']; ?></strong></p>
                    <a href="product_details.php?id=<?php echo $row['ProductNumber']; ?>" class="btn btn-primary">Details</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "No products found";
      }
      ?>
    </div>
  </div>
  <div class="container custom-container">
    <div class="row">
      <!-- Product having Lotus Herbals Brands-->
      <?php
      // Fetch 3 random products from the database
      $sqlLotusHerbals = "SELECT * FROM products WHERE productBrand = 'Lotus Herbals' ORDER BY RAND() LIMIT 6";
      $resultLotusHerbals = mysqli_query($conn, $sqlLotusHerbals);
      // Check if there are any products
      if (mysqli_num_rows($resultLotusHerbals) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($resultLotusHerbals)) {
      ?>
          <div class="col-md-4 productItem">
            <div class="card productcard">
              <div class="container">
                <img src="<?php echo $row['ProductLink']; ?>" class="card-img-top image" alt="<?php echo $row['ProductName']; ?>">
                <div class="overlay">
                  <div class="text">
                    <h5 class="card-title"><?php echo substr($row['ProductName'], 0, 20); ?></h5>

                    <p class="card-text"><strong>Price: ₹<?php echo $row['Price']; ?></strong></p>
                    <a href="product_details.php?id=<?php echo $row['ProductNumber']; ?>" class="btn btn-primary">Details</a>
                  </div>
                </div>
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
</section>

<?php include 'footer.php'; ?>
