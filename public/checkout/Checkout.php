<?php
include("../../includes/init.php");

// Get user ID from session
$userID = $_SESSION['userID'];

// Fetch cartID for the user
$cartQuery = $conn->prepare("SELECT cartID FROM carts WHERE userID = ?");
$cartQuery->bind_param("i", $userID);
$cartQuery->execute();
$cartQuery->bind_result($cartID);
$cartQuery->fetch();
$cartQuery->close();

$cartItems = [];
$totalPrice = 0;

if ($cartID) {
    // Fetch cart items with product details
    $cartItemsQuery = $conn->prepare("
        SELECT ci.productID, ci.size, ci.quantity, p.name, p.product_image, p.price 
        FROM cart_items ci
        JOIN products p ON ci.productID = p.product_id
        WHERE ci.cartID = ?
    ");
    $cartItemsQuery->bind_param("i", $cartID);
    $cartItemsQuery->execute();
    $result = $cartItemsQuery->get_result();
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
        $totalPrice += $row['price'] * $row['quantity'];
    }
    $cartItemsQuery->close();
}
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

    <!-- Links for styles -->
    <link rel="stylesheet" href="../../assets/css/checkout_header.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../../assets/css/Shopping_cart.css?v=<?= $version ?>">
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
                <span>&RightArrow;</span>
                <li>Shipping</li>
                <span>&RightArrow;</span>
                <li>Payment</li>
            </ul>
        </div>

        <div class="right-section">
            <a class="cart-link" href="Checkout.php">
                <img class="cart-icon" src="../../assets/images/icons/cart-icon.png" alt="Cart Icon">
                <div class="cart-quantity"><?php echo count($cartItems); ?></div>
            </a>
        </div>
    </header>

    <!-- Main section -->
    <main class="main">
        <div class="navigation-indicator">
            <ul>
                <li class="active">Shopping Cart</li>
                <span>&RightArrow;</span>
                <li>Shipping</li>
                <span>&RightArrow;</span>
                <li>Payment</li>
            </ul>
        </div>
        <div class="checkout-grid">
            <!-- Order Section -->
            <div class="order-section">
                <h1>Shopping Cart</h1>
                <div class="order-summary">
                    <?php if (!empty($cartItems)) : ?>
                        <?php foreach ($cartItems as $item) : ?>
                            <div class="product">
                                <div class="product-image">
                                    <img src="../../assets/images/products_bg/<?php echo htmlspecialchars($item['product_image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                                </div>
                                <div class="product-info">
                                    <div class="product-name"><?php echo htmlspecialchars($item['name']); ?></div>
                                    <div class="product-size-quantity-container">
                                        <select class="product-size">
                                            <option selected><?php echo htmlspecialchars($item['size']); ?></option>
                                        </select>
                                        <div class="product-quantity">
                                            <button class="decrement">-</button>
                                            <input type="number" min="1" max="5" value="<?php echo $item['quantity']; ?>">
                                            <button class="increment">+</button>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        &#8377;<?php echo number_format($item['price'], 2); ?>
                                    </div>
                                </div>
                                <div class="product-manage-buttons">
                                <button class="update" data-product-id="<?php echo $item['productID']; ?>"><i class="fas fa-edit"></i> Update</button>
                                <button class="save" data-product-id="<?php echo $item['productID']; ?>"><i class="fa-solid fa-check"></i> Save</button>
                                    <button class="remove" data-product-id="<?php echo $item['productID']; ?>"><i class="fas fa-trash"></i> Remove</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Your cart is empty.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="payment-section">
                <h1>Total</h1>
                <div class="payment-summary">
                    <div class="summary-row">
                        <div>Subtotal:</div>
                        <div class="summary-amount">&#8377;<?php echo number_format($totalPrice, 2); ?></div>
                    </div>
                    <div class="summary-row">
                        <div>Shipping:</div>
                        <div class="summary-amount">Calculated at checkout</div>
                    </div>
                    <div class="summary-row">
                        <div>Total:</div>
                        <div class="summary-amount">&#8377;<?php echo number_format($totalPrice, 2); ?></div>
                    </div>
                    <a href="Shipping.html" class="checkout-link">
                        Checkout now
                    </a>
                    <div class="navigation-link">
                        <a href="../Products.html">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Links for script -->
    <script src="../../scripts/header.js?v=<?= $version ?>" type="module"></script>

</body>
</html>
