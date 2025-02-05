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
    <link rel="stylesheet" href="../assets/css/orders.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/footer.css?v=<?= $version ?>">

</head>

<body>
    <!-- Header Section -->
    <?php
    include("../includes/header.php");
    ?>

    <div class="order-section">

        <!-- 1st container -->
        <div class="order-container">
            <div class="order-details">
                <div class="order-date">
                    <h3>Order Placed :</h3>
                    <span class="date">January 3</span>
                </div>
                <div class="order-price">
                    <h3>Order Total Price :</h3>
                    <span class="price">&#8377;5998</span>
                </div>
                <div class="order-id">
                    <h3>Order ID :</h3>
                    <span class="id">93741387-66d7-11ec-2f73-a79d34e9e3e7</span>
                </div>
            </div>
            <!-- product-1 -->
            <div class="order-item">
                <div class="product-image">
                    <img src="../assets/images/products_bg/Ballet Breeze W.jpg" alt="Ballet Breeze">
                </div>
                <div class="product-info">
                    <div class="product-name">Ballet Breeze</div>
                    <div class="product-size-quantity-container">
                        <span>Size : UK 10</span>
                        <span>Quantity : 1</span>
                        <div class="product-price">
                            &#8377;2999
                        </div>
                    </div>
                </div>
                <div class="product-links">
                    <button class="buy-again"><img src="../assets/images/icons/buy-again.png" alt="buy-again"> Buy It Again</button>
                    <button class="track">Track order</button>
                </div>
            </div>
            <!-- product 2 -->
            <div class="order-item">
                <div class="product-image">
                    <img src="../assets/images/products_bg/SkyWave Kicks K.jpg" alt="SkyWave Kicks">
                </div>
                <div class="product-info">
                    <div class="product-name">SkyWave Kicks</div>
                    <div class="product-size-quantity-container">
                        <span>Size : UK 10</span>
                        <span>Quantity : 1</span>
                        <div class="product-price">
                            &#8377;3999
                        </div>
                    </div>
                </div>
                <div class="product-links">
                    <button class="buy-again"><img src="../assets/images/icons/buy-again.png" alt="buy-again"> Buy It Again</button>
                    <button class="track">Track order</button>
                </div>
            </div>
        </div>

        <!-- 2nd container -->
        <div class="order-container">
            <div class="order-details">
                <div class="order-date">
                    <h3>Order Placed :</h3>
                    <span class="date">January 3</span>
                </div>
                <div class="order-price">
                    <h3>Order Total Price :</h3>
                    <span class="date">&#8377;2599</span>
                </div>
                <div class="order-id">
                    <h3>Order ID :</h3>
                    <span class="date">a4f8e363-0481-ab8f-606e-befa52e27027</span>
                </div>
            </div>
            <!-- product-1 -->
            <div class="order-item">
                <div class="product-image">
                    <img src="../assets/images/products_bg/Skyline Sprint M.jpg" alt="Skyline Sprint">
                </div>
                <div class="product-info">
                    <div class="product-name">Skyline Sprint</div>
                    <div class="product-size-quantity-container">
                        <span>Size : UK 10</span>
                        <span>Quantity : 1</span>
                        <div class="product-price">
                            &#8377;2599
                        </div>
                    </div>
                </div>
                <div class="product-links">
                    <button class="buy-again"><img src="../assets/images/icons/buy-again.png" alt="buy-again"> Buy It Again</button>
                    <button class="track">Track order</button>
                </div>
            </div>
        </div>
    </div>

    <!------------------- Links for script ---------------->
    <script type="module" src="../assets/js/header.js?v=<?= $version ?>"></script>
</body>

</html>