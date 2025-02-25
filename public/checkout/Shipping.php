<?php
session_start();
include("../../includes/init.php");

$userID = $_SESSION['userID'];

// Fetch cartID for the user
$cartQuery = $conn->prepare("SELECT cartID FROM carts WHERE userID = ?");
$cartQuery->bind_param("i", $userID);
$cartQuery->execute();
$cartQuery->bind_result($cartID);
$cartQuery->fetch();
$cartQuery->close();

//Fetching cart Quantity
$sql = "SELECT SUM(quantity) AS total_quantity FROM cart_items WHERE cartID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cartID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalCartQuantity = $row['total_quantity'];


// Fetch user details
$user_query = $conn->prepare("SELECT email FROM users WHERE userID = ?");
$user_query->bind_param("i", $userID);
$user_query->execute();
$user_result = $user_query->get_result();
$user = $user_result->fetch_assoc() ?? [];

// Fetch shipping address
$address_query = $conn->prepare("SELECT first_name, last_name, phone, state, city, postal_code, address FROM shipping_address WHERE userID = ?");
$address_query->bind_param("i", $userID);
$address_query->execute();
$address_result = $address_query->get_result();
$address = $address_result->fetch_assoc() ?? [];

$user_query->close();
$address_query->close();


// checking if all the values are present in database 
$hasAddress = !empty($address['first_name']) && !empty($address['last_name']) && !empty($address['phone']) && !empty($address['state']) && !empty($address['city']) && !empty($address['postal_code']) && !empty($address['address']);


// another method to check if all the values are present in database 
// $requiredFields = ['first_name', 'last_name', 'phone', 'state', 'city', 'postal_code', 'address'];
// $hasAddress = count(array_filter(array_intersect_key($address, array_flip($requiredFields)))) === count($requiredFields);


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
    <link rel="stylesheet" href="../../assets/css/shipping.css?v=<?= $version ?>">
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
                <span>&RightArrow;</span>
                <li>Payment</li>
            </ul>
        </div>

        <div class="right-section">
            <a class="cart-link" href="Checkout.php">
                <img class="cart-icon" src="../../assets/images/icons/cart-icon.png" alt="Cart Icon">
                <div class="cart-quantity"><?php echo $totalCartQuantity; ?></div>
            </a>
        </div>
    </header>

    <!-- Main Section -->
    <main class="main">
        <div class="checkout-grid">
            <div class="address-grid">
                <!-- Display form if address not present -->
                <form id="shipping-form" action="../../api/user/shipping-validate.php" method="POST" enctype="multipart/form-data" class="<?= $hasAddress ? 'hidden' : '' ?>">
                    <h1>Contacts</h1>
                    <div class="contact-container">
                        <div class="input-box">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" value="<?= htmlspecialchars($address['first_name'] ?? '') ?>" required>
                        </div>

                        <div class="input-box">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" value="<?= htmlspecialchars($address['last_name'] ?? '') ?>" required>
                        </div>

                        <div class="input-box">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                        </div>

                        <div class="input-box">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($address['phone'] ?? '') ?>" required>
                        </div>
                    </div>

                    <h1>Shipping Address</h1>
                    <div class="Shipping-container">
                        <div class="input-box">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" value="<?= htmlspecialchars($address['state'] ?? '') ?>" required>
                        </div>

                        <div class="input-box">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" value="<?= htmlspecialchars($address['city'] ?? '') ?>" required>
                        </div>

                        <div class="input-box">
                            <label for="postalCode">Postal Code</label>
                            <input type="text" id="postalCode" name="postalCode" value="<?= htmlspecialchars($address['postal_code'] ?? '') ?>" required>
                        </div>

                        <div class="input-box">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" required><?= htmlspecialchars($address['address'] ?? '') ?></textarea>
                        </div>
                    </div>
                    <button type="submit" class="save-btn">Save Address <i class="fa-solid fa-check"></i></button>
                </form>

                <!-- Display address if already present -->
                <div id="shipping-details" class="<?= $hasAddress ? '' : 'hidden' ?>">
                    <div class="contact-main">
                        <h1>Contacts</h1>
                        <button class="Edit-address-btn">Edit Address <i class="fas fa-edit"></i></button>
                    </div>
            
                    <div class="contact-container">
                        <div class="input-box">
                            <label>First Name</label>
                            <p><?= htmlspecialchars($address['first_name'] ?? 'N/A') ?></p>
                        </div>

                        <div class="input-box">
                            <label>Last Name</label>
                            <p><?= htmlspecialchars($address['last_name'] ?? 'N/A') ?></p>
                        </div>

                        <div class="input-box">
                            <label>Email</label>
                            <p><?= htmlspecialchars($user['email'] ?? 'N/A') ?></p>
                        </div>

                        <div class="input-box">
                            <label>Phone</label>
                            <p><?= htmlspecialchars($address['phone'] ?? 'N/A') ?></p>
                        </div>
                    </div>

                    <h1>Shipping Address</h1>
                    <div class="Shipping-container">
                        <div class="input-box">
                            <label>State</label>
                            <p><?= htmlspecialchars($address['state'] ?? 'N/A') ?></p>
                        </div>

                        <div class="input-box">
                            <label>City</label>
                            <p><?= htmlspecialchars($address['city'] ?? 'N/A') ?></p>
                        </div>

                        <div class="input-box">
                            <label>Postal Code</label>
                            <p><?= htmlspecialchars($address['postal_code'] ?? 'N/A') ?></p>
                        </div>

                        <div class="input-box">
                            <label>Address</label>
                            <p><?= htmlspecialchars($address['address'] ?? 'N/A')?></p>
                        </div>
                    </div>
                </div>
                <div class="shipping-charges">
                    <label class="shipping-option-card">
                        <input type="radio" name="shipping" value="0.00" checked class="shipping-option" data-price="0.00" checked >
                        <div class="shipping-info">
                            <i class="fas fa-truck"></i>
                            <div class="shipping-text">
                                <span class="shipping-title">Standard Shipping</span>
                                <span class="shipping-price">FREE</span>
                                <span class="shipping-date">Arrives by <?= date('M d', strtotime('+4 days')) ?> - <?= date('M d', strtotime('+5 days')) ?></span>
                            </div>
                        </div>
                    </label>

                    <label class="shipping-option-card">
                        <input type="radio" name="shipping" value="100.00" data-price="100.00" class="shipping-option" >
                        <div class="shipping-info">
                            <i class="fas fa-bolt"></i>
                            <div class="shipping-text">
                                <span class="shipping-title">Express Shipping</span>
                                <span class="shipping-price">&#8377;100</span>
                                <span class="shipping-date">Arrives by <?= date('M d', strtotime('+1 day')) ?> - <?= date('M d', strtotime('+3 days')) ?></span>
                            </div>
                        </div>
                    </label>
                </div>
            </div>


            <!-- Payment section -->
            <?php include('../../includes/payment_section.php'); ?>
        </div>
    </main>

    <script src="../../assets/js/shipping.js?v=<?= $version ?>" type="module"></script>
</body>
</html>
