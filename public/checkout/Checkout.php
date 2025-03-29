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
        SELECT ci.cartItemID, ci.productID, ci.size, ci.quantity, p.name, p.product_image, p.price, p.category 
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
    <?php 
        $pageType = 'checkout';
        include('../../includes/checkout_header.php'); 
    ?>

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
                <div class="order-summary">
                    <h1>Shopping Cart</h1>
                    <?php if (!empty($cartItems)) : ?>
                        <?php foreach ($cartItems as $item) : ?>
                            <div class="product">
                                <div class="product-image">
                                    <img src="../../assets/images/products_bg/<?php echo htmlspecialchars($item['product_image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                                </div>
                                <div class="product-info">
                                    <div class="product-name"><?php echo htmlspecialchars($item['name']); ?></div>
                                    <div class="product-category">
                                        <span>Category: </span>
                                        <span class="<?php echo htmlspecialchars($item['category']); ?>">
                                            <?php echo htmlspecialchars($item['category']); ?>
                                        </span>
                                    </div>
                                    <div class="product-size-quantity-container-1">
                                        <select class="product-size">
                                            <?php
                                                $sizes = [];
                                                if (strtolower($item['category']) === "men") {
                                                    $sizes = ["UK 6", "UK 7", "UK 8", "UK 9", "UK 10", "UK 11", "UK 12"];
                                                } elseif (strtolower($item['category']) === "women") {
                                                    $sizes = ["UK 4", "UK 5", "UK 6", "UK 7", "UK 8"];
                                                } elseif (strtolower($item['category']) === "kids") {
                                                    $sizes = ["UK 1", "UK 2", "UK 3", "UK 4", "UK 5"];
                                                }
                                                $selectedSize = htmlspecialchars($item['size']);
                                                // Loop through sizes and set the selected one
                                                foreach ($sizes as $size) {
                                                    $isSelected = ($size === $selectedSize) ? "selected" : "";
                                                    echo "<option value='$size' $isSelected>$size</option>";
                                                }

                                            ?>
                                        </select>
                                        <div class="product-quantity">
                                            <button class="minus-number">-</button>
                                            <input type="number" min="1" max="5" value="<?php echo $item['quantity']; ?>" class="number"> 
                                            <button class="add-number">+</button>
                                        </div>
                                    </div>
                                    <div class="product-size-quantity-container-2">
                                        <span>Size : <?php echo htmlspecialchars($item['size']); ?></span>
                                        <span>Quantity : <?php echo $item['quantity']; ?></span>
                                    </div>
                                    <div class="product-price">
                                        &#8377;<?php echo number_format($item['price']*$item['quantity'], 2); ?>
                                    </div>
                                </div>
                                <div class="product-manage-buttons">
                                    <button class="update-btn" data-cart-item-id="<?php echo $item['cartItemID']; ?>"><i class="fas fa-edit"></i> <span>Update</span></button>
                                    <button class="save-btn" data-cart-item-id="<?php echo $item['cartItemID']; ?>"><i class="fa-solid fa-check"></i> <span>Save<span></button>
                                    <button class="remove-btn" data-cart-item-id="<?php echo $item['cartItemID']; ?>"><i class="fas fa-trash"></i> <span>Remove<span></button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Your cart is empty.</p>
                        <a href="../Products.php" class="shop-btn">Shop now</a>
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
                    <button class="checkout-link">Checkout now <i class="fa-solid fa-shopping-bag"></i></button>
                    <div class="navigation-link">
                        <button class="shop-btn">Discover More <i class="fa-solid fa-cart-shopping"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Links for script -->
    <script src="../../assets/js/shopping_cart.js?v=<?= $version ?>" type="module"></script>
</body>
</html>
