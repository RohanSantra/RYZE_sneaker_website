<?php
require_once __DIR__ . "/init.php";

if ($is_logged_in){
    $userID = $_SESSION['userID'];
}



// Query to get the user's profile image
$user_query = $conn->prepare("SELECT image FROM users WHERE userID = ?");
$user_query->bind_param("i", $userID);
$user_query->execute();
$user_result = $user_query->get_result();
$user = $user_result->fetch_assoc();

// Step 1: Get the user's cartID
$cart_query = $conn->prepare("SELECT cartID FROM carts WHERE userID = ?");
$cart_query->bind_param("i", $userID);
$cart_query->execute();
$cart_query->store_result();

if ($cart_query->num_rows > 0) {
    $cart_query->bind_result($cartID);
    $cart_query->fetch();
    $cart_query->close();

    // Step 2: Get the total quantity of items in the cart
    $cart_items_query = $conn->prepare("
        SELECT SUM(quantity) AS total_quantity 
        FROM cart_items 
        WHERE cartID = ?
    ");
    $cart_items_query->bind_param("i", $cartID);
    $cart_items_query->execute();
    $cart_items_result = $cart_items_query->get_result();
    $cart_data = $cart_items_result->fetch_assoc();
    $cart_quantity = $cart_data['total_quantity'] ?? 0; // Default to 0 if no items
    $cart_items_query->close();
} else {
    // If no cart exists, quantity is 0
    $cart_quantity = 0;
    $cart_query->close();
}

?>

<div class="header-section">
    <!-- Logo Section -->
    <div class="left-section">
        <a class="header-link" href="Ryze.php">
            <img src="../assets/images/Ryze.png" alt="Ryze Logo" class="ryze-logo">
        </a>
    </div>

    <!-- Links Section -->
    <div class="middle-section">
        <!-- Hamburger close button for width < 768px -->
        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e8eaed"
            class="close-sidebar-button">
            <path
                d="m251.33-204.67-46.66-46.66L433.33-480 204.67-708.67l46.66-46.66L480-526.67l228.67-228.66 46.66 46.66L526.67-480l228.66 228.67-46.66 46.66L480-433.33 251.33-204.67Z" />
        </svg>

        <a href="Ryze.php">
            <span>Home</span>
        </a>
        <a href="Products.php">
            <span>Products</span>
        </a>
        <a href="About.php">
            <span>About</span>
        </a>
        <a href="Contact.php">
            <span>Contact</span>
        </a>
        <a class="orders-link header-link" href="Orders.php">
            <span>Orders</span>
        </a>

        <?php if (!$is_logged_in): ?>
            <div class="btn-section">
                <!-- Show Login and Sign Up buttons when user is not logged in -->
                <button class="login-btn">
                    <img src="../assets/images/icons/login.png" alt="Login_icon" class="login-img"> Login
                </button>
                <button class="signup-btn">
                    <img src="../assets/images/icons/add-user.png" alt="sign-up_icon" class="signup-img"> Sign Up
                </button>
            </div>
        <?php else: ?>
            <!-- navigate user to profile.php if user is logged in  -->
            <div class="user-navigation">
                <a href="profile.php" class="navigator-link">
                    <?php
                    // Display profile image (default if none is set)
                    $profileImage = !empty($user['image']) ? "../assets/images/uploaded_img/{$user['image']}" : "../assets/images/icons/default-avatar.png";
                    echo '<img src="' . htmlspecialchars($profileImage) . '" alt="Profile Picture" class="user-img">';
                    ?>
                    <span>Hello, <?php echo htmlspecialchars($username); ?></span>
                </a>
            </div>
        <?php endif; ?>

    </div>

    <!-- Cart Section -->
    <div class="right-section">
        <?php if (!$is_logged_in): ?>
            <!-- Show Login and Sign Up buttons when user is not logged in -->
            <button class="login-btn">
                <img src="../assets/images/icons/login.png" alt="Login_icon" class="login-img"> Login
            </button>
            <button class="signup-btn">
                <img src="../assets/images/icons/add-user.png" alt="sign-up_icon" class="signup-img"> Sign Up
            </button>
        <?php else: ?>
            <!-- Show dropdown with user information when logged in -->
            <div class="user-dropdown">
                <?php
                // Display profile image (default if none is set)
                $profileImage = !empty($user['image']) ? "../assets/images/uploaded_img/{$user['image']}" : "../assets/images/icons/default-avatar.png";
                echo '<img src="' . htmlspecialchars($profileImage) . '" alt="Profile Picture" class="user-img">';
                ?>
                <span>Hello, <?php echo htmlspecialchars($username); ?></span>
                <div class="dropdown-menu">
                    <a href="profile.php"><i class='bx bx-user'></i>Profile</a>
                    <a href="../api/user/logout.php"><i class='bx bxs-door-open' ></i>Logout</a>
                </div>
            </div>
        <?php endif; ?>


        <!-- Cart Section -->
        <a class="cart-link" href="checkout/Checkout.php">
            <img class="cart-icon" src="../assets/images/icons/cart-icon.png" alt="Cart Icon">
            <div class="cart-quantity"><?php echo $cart_quantity; ?></div>
        </a>

        <!-- Hamburger open button for width < 768px -->
        <div class="side-close"></div>
        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e8eaed"
            class="open-sidebar-button">
            <path d="M120-240v-66.67h720V-240H120Zm0-206.67v-66.66h720v66.66H120Zm0-206.66V-720h720v66.67H120Z" />
        </svg>
    </div>
</div>
