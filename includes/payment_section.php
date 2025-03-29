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

// Fetch shipping address
$address_query = $conn->prepare("SELECT first_name, last_name, phone, state, city, postal_code, address FROM shipping_address WHERE userID = ?");
$address_query->bind_param("i", $userID);
$address_query->execute();
$address_result = $address_query->get_result();
$address = $address_result->fetch_assoc() ?? [];

$address_query->close();


// checking if all the values are present in database 
$hasAddress = !empty($address['first_name']) && !empty($address['last_name']) && !empty($address['phone']) && !empty($address['state']) && !empty($address['city']) && !empty($address['postal_code']) && !empty($address['address']);
?>

<div class="payment-section">
    <div class="payment-summary">
        <div class="summary-row">
            <h1>Your order</h1>
            <a href="Checkout.php">Edit cart <i class='bx bx-edit-alt'></i></a>
        </div>
        <!-- Product summary -->
        <?php foreach ($cartItems as $item): ?>
            <div class="summary-row">
                <div class="product">
                    <div class="product-image">
                        <img src="../../assets/images/products_bg/<?php echo htmlspecialchars($item['product_image']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>">
                    </div>
                    <div class="product-info">
                        <div class="product-name"><?php echo htmlspecialchars($item['name']); ?></div>
                        <div class="product-category">
                            <span>Category: </span>
                            <span class="<?php echo htmlspecialchars($item['category']); ?>">
                                <?php echo htmlspecialchars($item['category']); ?>
                            </span>
                        </div>
                        <div class="product-size-quantity-container">
                            <span>Size: <?php echo htmlspecialchars($item['size']); ?></span>
                            <span>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></span>
                        </div>
                    </div>
                    <div class="product-price">
                        &#8377;<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Amount summary -->
        <div class="summary-row line">
            <div>Subtotal:</div>
            <div class="summary-amount">&#8377;<?php echo number_format($totalPrice, 2); ?></div>
        </div>
        <div class="summary-row">
            <div>Shipping:</div>
            <div class="summary-amount"><span id="shipping-cost"></span></div>
        </div>
        <div class="summary-row line">
            <div>Total:</div>
            <div class="summary-amount total-amount">&#8377;<?php echo number_format($totalPrice, 2); ?></div>
        </div>
        <!-- Payment or Order Button -->
        <?php if ($pageType === 'shipping'): ?>
            <button class="payment-link <?= $hasAddress ? '' : 'hidden' ?>">Continue to payment <i class="fa-solid fa-credit-card"></i></button>
            <p class="fill-address-warning <?= $hasAddress ? 'hidden' : '' ?>">*Please fill your address</p>
            <div class="navigation-link">
                <button class="shop-btn">Keep Shopping <i class="fa-solid fa-cart-shopping"></i></button>
            </div>
        <?php else: ?>
            <button class="confirm-purchase-btn <?= $hasAddress ? '' : 'hidden' ?>">Complete purchase <img src="../../assets/images/icons/Ryze_sneaker.png" alt="Ryze_sneaker"></button>
            <p class="fill-address-warning <?= $hasAddress ? 'hidden' : '' ?>">*Please fill your address</p>
            <div class="shipping-navigation-link">
                <button class="shipping-btn">Back to shipping <i class="fas fa-truck"></i></button>
            </div>
        <?php endif; ?>

    </div>
</div>
