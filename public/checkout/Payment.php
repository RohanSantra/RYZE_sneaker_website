<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ryze</title>

    <!-- Links for icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Links for styles -->
    <link rel="stylesheet" href="../../assets/css/checkout_header.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../../assets/css/payment.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../../assets/css/payment_section.css?v=<?= $version ?>">

</head>

<body>
    <!-- Header Section -->
    <header class="header-section">
        <div class="left-section">
            <a class="header-link" href="../Ryze.php">
                <img src="../../assets/images/Ryze.png" alt="Ryze Logo" class="ryze-logo">
            </a>
        </div>

        <div class="navigation-indicator">
            <ul>
                <li class="active">Shopping Cart</li>
                <span class="active">&RightArrow;</span>
                <li class="active">Shipping</li>
                <span class="active">&RightArrow;</span>
                <li class="active">Payment</li>
            </ul>
        </div>

        <div class="right-section">
            <a class="cart-link" href="Checkout.html">
                <img class="cart-icon" src="../../assets/images/icons/cart-icon.png" alt="Cart Icon">
                <div class="cart-quantity">0</div>
            </a>
        </div>
    </header>

    <!-- main section -->
    <main class="main">
        <div class="navigation-indicator">
            <ul>
                <li class="active">Shopping Cart</li>
                <span class="active">&RightArrow;</span>
                <li class="active">Shipping</li>
                <span class="active">&RightArrow;</span>
                <li class="active">Payment</li>
            </ul>
        </div>
        <div class="checkout-grid">
            <div class="payment-grid">
                <h1>Payment method</h1>
                <div class="payment-option" data-type="card">
                    <label for="card">
                        <input type="radio" id="card" name="payment-type" required><i
                            class='bx bxs-credit-card-alt'></i>Card
                    </label>
                    <div class="dropdown-content" id="card-details">
                        <input type="text" placeholder="Cardholder Name">
                        <input type="number" placeholder="Card Number">
                        <input type="text" placeholder="Expiry date">
                        <input type="number" placeholder="CVV">
                    </div>
                </div>
                <div class="payment-option" data-type="online">
                    <label for="online">
                        <input type="radio" id="online" name="payment-type" required>
                        <img src="../../assets/images/icons/mobile-payment.png" alt="mobile-payment" height="32px">
                        Online Payment
                    </label>
                    <div class="dropdown-content" id="online-details">
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="online-app" value="PayPal">
                                <img src="../../assets/images/icons/paypal.png" alt="mobile-payment" height="32px">
                                PayPal
                            </label>
                            <label>
                                <input type="radio" name="online-app" value="Google Pay">
                                <img src="../../assets/images/icons/google-pay.png" alt="mobile-payment" height="32px">
                                Google Pay
                            </label>
                            <label>
                                <input type="radio" name="online-app" value="Apple Pay">
                                <img src="../../assets/images/icons/apple-pay.png" alt="mobile-payment" height="32px">
                                Apple Pay
                            </label>
                            <label>
                                <input type="radio" name="online-app" value="PhonePay">
                                <img src="../../assets/images/icons/phonepe-icon.png" alt="mobile-payment"
                                    height="32px"> PhonePay
                            </label>
                            <label>
                                <input type="radio" name="online-app" value="Paytm">
                                <img src="../../assets/images/icons/paytm-icon.png" alt="mobile-payment" height="32px">
                                Paytm
                            </label>
                        </div>
                    </div>
                </div>
                <div class="payment-option" data-type="cash">
                    <label for="cash">
                        <input type="radio" id="cash" name="payment-type" required><i class='bx bx-money'></i> Cash on
                        Delivery
                    </label>
                </div>
            </div>

            <!-- payment section -->
            <div class="payment-section">
                <div class="payment-summary">
                    <div class="summary-row">
                        <h1>Your order</h1>
                        <a href="Checkout.html">Edit cart</a>
                    </div>
                    <!-- product summary -->
                    <div class="summary-row">
                        <!-- Product 1 -->
                        <div class="product">
                            <div class="product-image">
                                <img src="../../assets/images/products_bg/Ballet Breeze W.jpg" alt="Ballet Breeze">
                            </div>
                            <div class="product-info">
                                <div class="product-name">Ballet Breeze</div>
                                <div class="product-size-quantity-container">
                                    <span>Size : UK 8</span>
                                    <span>Quantity : 1</span>
                                </div>
                            </div>
                            <div class="product-price">
                                &#8377;2999
                            </div>
                        </div>
                    </div>
                    <div class="summary-row">
                        <!-- Product 2 -->
                        <div class="product">
                            <div class="product-image">
                                <img src="../../assets/images/products_bg/SkyWave Kicks K.jpg" alt="Ballet Breeze">
                            </div>
                            <div class="product-info">
                                <div class="product-name">SkyWave Kicks</div>
                                <div class="product-size-quantity-container">
                                    <span>Size : UK 4</span>
                                    <span>Quantity : 1</span>
                                </div>
                            </div>
                            <div class="product-price">
                                &#8377;3999
                            </div>
                        </div>
                    </div>
                    <div class="summary-row">
                        <!-- Product 3 -->
                        <div class="product">
                            <div class="product-image">
                                <img src="../../assets/images/products_bg/Skyline Sprint M.jpg" alt="Ballet Breeze">
                            </div>
                            <div class="product-info">
                                <div class="product-name">Skyline Sprint</div>
                                <div class="product-size-quantity-container">
                                    <span>Size : UK 10</span>
                                    <span>Quantity : 1</span>
                                </div>
                            </div>
                            <div class="product-price">
                                &#8377;2599
                            </div>
                        </div>
                    </div>

                    <!-- amount summary -->
                    <div class="summary-row line">
                        <div>Subtotal:</div>
                        <div class="summary-amount">&#8377;9597.00</div>
                    </div>
                    <div class="summary-row">
                        <div>Shipping:</div>
                        <div class="summary-amount">&#8377;0.00</div>
                    </div>
                    <div class="summary-row line">
                        <div>Total:</div>
                        <div class="summary-amount">&#8377;9597.00</div>
                    </div>
                    <a href="../orders.html" class="checkout-link">
                        Complete purchase
                    </a>
                    <div class="navigation-link">
                        <a href="Shipping.html">Back to shipping</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Links for script -->
    <script src="../../assets/js/payment_option.js?v=<?= $version ?>" type="module"></script>
</body>

</html>