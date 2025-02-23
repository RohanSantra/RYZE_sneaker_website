<?php
include("../includes/config.php");
?>
<!DOCTYPE html>
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
    <link rel="stylesheet" href="../assets/css/hero.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/home.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/products.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/footer.css?v=<?= $version ?>">

</head>

<body>

    <!-- Header section -->
    <?php
    include("../includes/header.php");
    ?>

    <!-- Hero Section -->
    <section class="carousel">
        <div class="list">
        <?php
        // IDs to fetch
        $productIds = [11, 34, 20, 43, 33]; // Replace with the specific product IDs you want to show

        // Prepare SQL query
        $sql = "SELECT * FROM products WHERE product_id IN (" . implode(",", $productIds) . ") ORDER BY FIELD(product_id, " . implode(",", $productIds) . ")";
        $result = $conn->query($sql);

        // Check if products are found
        if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {
                ?>
            
                <div class="item">
                    <div class="image">
                    <img src="../assets/images/products/<?php echo $product['product_image_no_bg']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                    <div class="content">
                        <h2 class="animate-on-slide right-left"><?php echo $product['name']; ?></h2>
                        <p class="description animate-on-slide left-right">
                            <?php echo $product['product_description']; ?>
                        </p>
                        <div class="more animate-on-slide right-left">
                            <!-- <button><i class="fa-solid fa-cart-shopping"></i> Add to cart</button> -->
                            <button class="view">View More</button>
                        </div>
                    </div>
                </div>
            
        <?php
            }
        }
        ?>
        </div>
        <!-- Arrows for navigation -->
        <div class="arrows">
            <button id="prev">&lt;</button>
            <button id="next">&gt;</button>
        </div>

        <!-- Indicators -->
        <div class="indicators">
            <ul>
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </section>

    <!-- featured section -->
    <!-- <section class="featured-collection">
        <div class="container">
            <h2 class="section-title">Winter Collection '25</h2>
            <p class="section-subtitle">Step Into Comfort and Style</p>
            <div class="collection-banner">
                <img src="https://i.pinimg.com/736x/79/db/e6/79dbe6fe009a2dc44bc1c1386127eeaa.jpg"
                    alt="Winter Collection Banner">
                <div class="cta-overlay">
                    <a href="/collections/winter" class="cta-button">Shop the Collection</a>
                </div>
            </div>
            <div class="product-carousel">
                <div class="product-item">
                    <img src="../assets/images/products_bg/Blue Mist W.jpg" alt="Blue Mist">
                    <h3 class="product-name">Blue Mist</h3>
                    <p class="product-price">&#8377;1599</p>
                    <a href="/product/glacier-x" class="btn btn-primary">View Product</a>
                </div>
                <div class="product-item">
                    <img src="../assets/images/products_bg/SkyWave Kicks K.jpg" alt="SkyWave Kicks">
                    <h3 class="product-name">SkyWave Kicks</h3>
                    <p class="product-price">&#8377;2699</p>
                    <a href="/product/arctic-rush" class="btn btn-primary">View Product</a>
                </div> -->
    <!-- Add more product items -->
    <!-- </div>
        </div>
    </section> -->


    <!-- collection section -->
    <section class="collection">
        <h1>Shop by Collection</h1>
        <p class="collection-subtitle">Discover the perfect style for everyone – Men, Women, and Kids.</p>
        <div class="collection-container">

        <div class="mens-collection">
            <span class="mens-info-1">Explore the latest</span>
            <span class="mens-info-2">Mens Collection</span>
            <button class="mens-btn" data-category="Men">SEE PRODUCTS</button>
        </div>
        <div class="women-collection">
            <span class="women-info-1">Explore the latest</span>
            <span class="women-info-2">Womens Collection</span>
            <button class="women-btn" data-category="Women">SEE PRODUCTS</button>
        </div>
        <div class="kids-collection">
            <span class="kids-info-1">Explore the latest</span>
            <span class="kids-info-2">Kids Collection</span>
            <button class="kids-btn" data-category="Kids">SEE PRODUCTS</button>
        </div>

        </div>
    </section>


    <!-- product section -->
    <section class="main hero-main">
        <h1>Top Picks</h1>
        <p class="subtitle">Discover our bestsellers, designed to deliver unmatched style, comfort, and performance.</p>
        <!-- product container -->
        <div class="products-container">
        <?php

        // IDs to fetch (or fetch all products)
        $productIds = [18, 19, 35, 36, 44, 28, 2, 3]; // Replace with specific IDs if needed
        $sql = "SELECT * FROM products WHERE product_id IN (" . implode(",", $productIds) . ")";
        $result = $conn->query($sql);

        // Check if products are found
        if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {
                ?>
                <div class="product" data-ID="<?php echo htmlspecialchars($product['product_id']); ?>">
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

    <!-- Blog Section -->
    <section class="blog">
        <h1>From Our Blog</h1>
        <p class="subtitle">Explore the latest trends, tips, and stories from the world of sneakers – crafted for every
            step of your journey.</p>
        <div class="blog-container">
            <!-- Blog Section 1 -->
            <div class="blog-post">
                <div class="blog-img">
                    <img src="../assets/images/About section images/movement-image-1.jpg" alt="movement-image-1">
                </div>
                <h2>5 Ways to Elevate Your Style</h2>
                <p>Discover top trends and styling tips that will make you stand out...</p>
                <a href="Blog.html" class="read-more">Read More</a>
            </div>
            <div class="blog-post">
                <div class="blog-img">
                    <img src="../assets/images/About section images/movement-image-2.jpg" alt="movement-image-2">
                </div>
                <h2>RYZE Community Stories</h2>
                <p>Get inspired by stories from the RYZE community...</p>
                <a href="Blog.html" class="read-more">Read More</a>
            </div>
            <div class="blog-post">
                <div class="blog-img">
                    <img src="../assets/images/About section images/movement-image-3.jpg" alt="movement-image-3">
                </div>
                <h2>Mastering Work-Life Balance</h2>
                <p>Tips and tricks to balance your career and personal life seamlessly...</p>
                <a href="Blog.html" class="read-more">Read More</a>
            </div>
            <div class="blog-post">
                <div class="blog-img">
                    <img src="../assets/images/About section images/movement-image-4.jpg" alt="movement-image-4">
                </div>
                <h2>Building Confidence Every Day</h2>
                <p>Learn how to cultivate confidence through small daily actions...</p>
                <a href="Blog.html" class="read-more">Read More</a>
            </div>
        </div>
    </section>

    <!-- sneaker care tip section -->
    <section class="sneaker-care-tips">
        <div class="container">
            <h2 class="section-title">Sneaker Care Tips</h2>
            <p class="section-subtitle">Prolong the life of your sneakers with these simple tips.</p>
            <div class="care-tips-grid">
                <div class="care-tip">
                    <img src="../assets/images/icons/spray.png" alt="Clean Regularly">
                    <h3>Clean Regularly</h3>
                    <p>Use a soft brush and sneaker cleaner to keep your kicks fresh.</p>
                </div>
                <div class="care-tip">
                    <img src="../assets/images/icons/wind.png" alt="Avoid Direct Heat">
                    <h3>Avoid Direct Heat</h3>
                    <p>Air-dry your sneakers naturally instead of using heaters or dryers.</p>
                </div>
                <div class="care-tip">
                    <img src="../assets/images/icons/shoe-rack.png" alt="Store Properly">
                    <h3>Store Properly</h3>
                    <p>Keep sneakers in a cool, dry place to avoid warping or discoloration.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- policy section -->
    <section class="policy-section-container">
        <h1>Services</h1>
        <p class="policy-subtitle">Experience exceptional support with fast delivery, easy returns, and personalized
            customer care</p>
        <div class="policy-section">
            <div class="shipping">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#e8eaed">
                    <path
                        d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z" />
                </svg>
                <div class="shipping-info">
                    <span class="info-1">FREE SHIPPING</span>
                    <span class="info-2">Free shipping on all orders</span>
                </div>
            </div>
            <div class="support">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#e8eaed">
                    <path
                        d="M440-120v-80h320v-284q0-117-81.5-198.5T480-764q-117 0-198.5 81.5T200-484v244h-40q-33 0-56.5-23.5T80-320v-80q0-21 10.5-39.5T120-469l3-53q8-68 39.5-126t79-101q47.5-43 109-67T480-840q68 0 129 24t109 66.5Q766-707 797-649t40 126l3 52q19 9 29.5 27t10.5 38v92q0 20-10.5 38T840-249v49q0 33-23.5 56.5T760-120H440Zm-80-280q-17 0-28.5-11.5T320-440q0-17 11.5-28.5T360-480q17 0 28.5 11.5T400-440q0 17-11.5 28.5T360-400Zm240 0q-17 0-28.5-11.5T560-440q0-17 11.5-28.5T600-480q17 0 28.5 11.5T640-440q0 17-11.5 28.5T600-400Zm-359-62q-7-106 64-182t177-76q89 0 156.5 56.5T720-519q-91-1-167.5-49T435-698q-16 80-67.5 142.5T241-462Z" />
                </svg>
                <div class="support-info">
                    <span class="info-1">ONLINE SUPPORT</span>
                    <span class="info-2">Online support 24 hours a day</span>
                </div>
            </div>
            <div class="return">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#e8eaed">
                    <path
                        d="M480-40q-112 0-206-51T120-227v107H40v-240h240v80h-99q48 72 126.5 116T480-120q75 0 140.5-28.5t114-77q48.5-48.5 77-114T840-480h80q0 91-34.5 171T791-169q-60 60-140 94.5T480-40Zm-36-160v-52q-47-11-76.5-40.5T324-370l66-26q12 41 37.5 61.5T486-314q33 0 56.5-15.5T566-378q0-29-24.5-47T454-466q-59-21-86.5-50T340-592q0-41 28.5-74.5T446-710v-50h70v50q36 3 65.5 29t40.5 61l-64 26q-8-23-26-38.5T482-648q-35 0-53.5 15T410-592q0 26 23 41t83 35q72 26 96 61t24 77q0 29-10 51t-26.5 37.5Q583-274 561-264.5T514-250v50h-70ZM40-480q0-91 34.5-171T169-791q60-60 140-94.5T480-920q112 0 206 51t154 136v-107h80v240H680v-80h99q-48-72-126.5-116T480-840q-75 0-140.5 28.5t-114 77q-48.5 48.5-77 114T120-480H40Z" />
                </svg>
                <div class="return-info">
                    <span class="info-1">MONEY RETURN</span>
                    <span class="info-2">Back guarantee under 5 days</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer section -->
    <footer>
        <div class="container">
            <!-- Column 1: Branding & About -->
            <div class="column">
                <h2>About Us</h2>
                <p>RYZE is committed to elevating your game, offering unmatched content, and providing opportunities to
                    connect
                    and grow.</p>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="column">
                <h2>Quick Links</h2>
                <ul class="anchor-links">
                    <li><a href="Policies.php">Policies</a></li>
                    <li><a href="About.php">About</a></li>
                    <li><a href="FAQ.php">FAQ</a></li>
                    <li><a href="Contact.php">Contact</a></li>
                </ul>
            </div>

            <!-- Column 3: Newsletter -->
            <div class="column">
                <h2>Newsletter</h2>
                <p>Subscribe to our newsletter for the latest updates:</p>
                <div class="newsletter">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit">Subscribe</button>
                </div>
            </div>

            <!-- Column 4: Social Media -->
            <div class="column">
                <h2>Follow Us</h2>
                <div class="social-icons">
                    <a href="#"><i class="bx bxl-instagram"></i></a>
                    <a href="#"><i class="bx bxl-facebook-square"></i></a>
                    <a href="#"><i class="bx bxl-twitter"></i></a>
                </div>
            </div>

            <!-- Row 2:Address section -->
            <div class="column">
                <h2>Address:</h2>
                <p>1234 Ryze Street, Suite 100, City, State, 12345</p>
            </div>

            <!-- Row 2:Phone number -->
            <div class="column">
                <h2>Phone:</h2>
                <li>(123) 456-7890</li>
                <li>(123) 456-7890</li>
            </div>

            <!-- Row 2:Email section -->
            <div class="column">
                <h2>Email:</h2>
                <li>contact@ryze.com</li>
                <li>contact@ryze.com</li>
            </div>
        </div>

        <!-- Bottom Row -->
        <div class="bottom-row">
            Copyright &copy; 2024 Ryze, All Rights Reserved.
        </div>
    </footer>

    <!------------------- Links for script ---------------->
    <script type="module" src="../assets/js/header.js?v=<?= $version ?>"></script>
    <script type="module" src="../assets/js/hero.js?v=<?= $version ?>"></script>
</body>

</html>