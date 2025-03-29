<?php
include('../includes/init.php');
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ryze</title>

  <!------------------- Links for icons ---------------->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!------------------- Links for styles ---------------->
  <link rel="stylesheet" href="../assets/css/header.css?v=<?= $version ?>">
  <link rel="stylesheet" href="../assets/css/product.css?v=<?= $version ?>">  
  <link rel="stylesheet" href="../assets/css/footer.css?v=<?= $version ?>">

</head>

<body>
  <!-- Header Section -->
  <?php
  include("../includes/header.php");
  ?>

  <!-- Product section -->
  <?php
  // Fetch product data based on an ID passed via URL
  $product_id = intval($_GET['ID']); // Default to product ID 1 if not set

  if($product_id > 0) {
      $sql = "SELECT * FROM products WHERE product_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $product_id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          $product = $result->fetch_assoc();
      } else {
          echo "No product found with this ID.";
      }

      $stmt->close();
  } else {
      echo "Invalid Product ID.";
  }
  $product_category=$product['category'];
  ?>

  <section class="Product">
      <div class="product-container">
          <div class="product-image">
              <img src="../assets/images/products_bg/<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
          </div>

          <div class="product-details">
              <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
              <div class="product-category">
                  <span>Category: </span>
                  <span class="<?php echo htmlspecialchars($product['category']); ?>">
                      <?php echo htmlspecialchars($product['category']); ?>
                  </span>
              </div>

              <div class="product-description">
                  <p><?php echo htmlspecialchars($product['product_description']); ?></p>
              </div>

              <div class="product-price">
                  &#8377;<?php echo number_format($product['price'], 2); ?>
              </div>

              <!-- Sizes -->
              <div class="product-sizes">
                  <label>Size:</label>
                  <div class="size-options">
                      <?php
                      $sizes = explode(",", $product['sizes']);
                      $first = true; // Initialize $first to true before the loop
                        foreach ($sizes as $size) {
                            echo '<label class="size-option">
                                    <input type="radio" name="size-' . htmlspecialchars($product['product_id']) . '" value="UK ' . htmlspecialchars($size) . '" class="product-size" ' . ($first ? 'checked' : '') . '>
                                    <span class="size-label">UK ' . htmlspecialchars($size) . '</span>
                                </label>';
                            $first = false; // Set $first to false after the first iteration
                        }
                      ?>
                  </div>
              </div>

              <!-- Quantity Selector -->
              <div class="product-quantity">
                  <label for="quantity">Quantity:</label>
                  <div class="product-quantity-container">
                      <button class="minus-number">&minus;</button>
                      <input type="number" min="1" max="5" value="1" class="number">
                      <button class="add-number">&plus;</button>
                  </div>
              </div>

              <!-- Add to Cart Button -->
              <button class="add-to-cart-button" data-product-id="<?php echo $product['product_id'] ?>">
                  <i class="fa-solid fa-cart-shopping"></i> Add to Cart
              </button>
          </div>
      </div>
  </section>



  <section class="sub_products">
        <h1>Discover More Amazing Finds!</h1>
        <!-- <p class="subtitle">Discover our bestsellers, designed to deliver unmatched style, comfort, and performance.</p> -->
        <!-- product container -->
        <div class="products-container">
        <?php
        $sql = "SELECT * FROM products WHERE category ='$product_category' /*ORDER BY rand()*/ LIMIT 8";
        $result = $conn->query($sql);

        // Check if products are found
        if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {
                ?>
                  <div class="products" data-ID="<?php echo htmlspecialchars($product['product_id']); ?>">
                      <div class="product-image-container">
                          <img src="../assets/images/products_bg/<?php echo $product['product_image']; ?>" class="product-image" alt="<?php echo $product['product_image']; ?>">
                      </div>

                      <div class="product-category <?php echo strtolower($product['category']); ?>">
                          <span>Category : </span>
                          <span class="<?php echo ucfirst($product['category']); ?>"><?php echo ucfirst($product['category']); ?></span>
                      </div>

                      <div class="product-name">
                          <?php echo $product['name']; ?>
                      </div>

                      <div class="product-price">
                          &#8377;<?php echo number_format($product['price'], 2); ?>
                      </div>

                      <div class="product-size-quantiy-container">
                          <div class="product-size-container">
                              <select class="product-size">
                                  <?php
                                  // Generate sizes based on category
                                  $sizes = [];
                                  if (strtolower($product['category']) === "men") {
                                    $sizes = ["UK 6", "UK 7", "UK 8", "UK 9", "UK 10", "UK 11", "UK 12"];
                                  } elseif (strtolower($product['category']) === "women") {
                                      $sizes = ["UK 4", "UK 5", "UK 6", "UK 7", "UK 8"];
                                  } elseif (strtolower($product['category']) === "kids") {
                                      $sizes = ["UK 1", "UK 2", "UK 3", "UK 4", "UK 5"];
                                  }

                                  foreach ($sizes as $size) {
                                      echo "<option value='$size'>$size</option>";
                                  }
                                  ?>
                              </select>
                          </div>
                          <div class="product-quantity-container">
                              <button class="minus-number">&minus;</button>
                              <input type="number" min="1" max="5" value="1" class="number">
                              <button class="add-number">&plus;</button>
                          </div>
                      </div>
                      <button class="add-to-cart-button" data-product-id="<?php echo htmlspecialchars($product['product_id']) ?>">
                          <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                      </button>
                  </div>
                  <?php
              }
          }
          ?>

          </div>
    </section>

    <!-- footer section -->
    <?php
        include("../includes/footer.php");
    ?>


  <!------------------- Links for script ---------------->
  <script type="module" src="../assets/js/header.js?v=<?= $version ?>"></script>
  <script type="module" src="../assets/js/product.js?v=<?= $version ?>"></script>

</body>

</html>