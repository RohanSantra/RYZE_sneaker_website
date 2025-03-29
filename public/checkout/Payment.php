<?php
include("../../includes/init.php");
$userID = $_SESSION['userID'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ryze</title>

    <!-- Links for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Links for styles -->
    <link rel="stylesheet" href="../../assets/css/checkout_header.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../../assets/css/payment.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../../assets/css/payment_section.css?v=<?= $version ?>">

</head>

<body>
    <!-- Header Section -->
    <?php 
        $pageType = 'payment';
        include('../../includes/checkout_header.php'); 
    ?>

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

                <div class="error-box">
                    <p class="error-msg">*hello hfiauiubfoabobfoabo</p>
                </div>
            </div>

            <!-- payment section -->
            <?php 
                $pageType = 'payment';
                include('../../includes/payment_section.php'); 
            ?>
        </div>
    </main>

    <!-- Links for script -->
    <script src="../../assets/js/payment_option.js?v=<?= $version ?>" type="module"></script>
</body>

</html>