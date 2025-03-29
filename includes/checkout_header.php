<?php

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
?>

<header class="header-section">
    <div class="left-section">
        <a class="header-link" href="../Ryze.php">
            <img src="../../assets/images/Ryze.png" alt="Ryze Logo" class="ryze-logo">
        </a>
    </div>
    <div class="navigation-indicator">
        <ul>
        <?php if ($pageType === 'checkout'): ?>
            <li class="active">Shopping Cart</li>
            <span>&RightArrow;</span>
            <li>Shipping</li>
            <span>&RightArrow;</span>
            <li>Payment</li>
        <?php elseif ($pageType === 'shipping'): ?>
            <li class="active">Shopping Cart</li>
            <span class="active">&RightArrow;</span>
            <li class="active">Shipping</li>
            <span>&RightArrow;</span>
            <li>Payment</li>
        <?php else: ?>
            <li class="active">Shopping Cart</li>
            <span class="active">&RightArrow;</span>
            <li class="active">Shipping</li>
            <span class="active">&RightArrow;</span>
            <li class="active">Payment</li>
        <?php endif; ?>
        </ul>
    </div>
    <div class="right-section">
        <a class="cart-link" href="Checkout.php">
            <img class="cart-icon" src="../../assets/images/icons/cart-icon.png" alt="Cart Icon">
            <div class="cart-quantity"><?php echo $totalCartQuantity?$totalCartQuantity:0; ?></div>
        </a>
    </div>
</header>