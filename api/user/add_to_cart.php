<?php

include("../../includes/init.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userID = $_SESSION['userID']; // Get user ID from session
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];
    $quantity = (int) $_POST['quantity'];

    // Fetch product details (like price) from the database
    // $sql = "SELECT price, name FROM products WHERE productID = ?";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("i", $product_id);
    // $stmt->execute();
    // $stmt->bind_result($price, $name);
    // $stmt->fetch();
    // $stmt->close();

    // Step 1: Check if user already has a cart
    $cart_sql = "SELECT cartID FROM carts WHERE userID = ?";
    $stmt = $conn->prepare($cart_sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($cartID);
        $stmt->fetch();
    } else {
        // Create a new cart for the user
        $insert_cart_sql = "INSERT INTO carts (userID) VALUES (?)";
        $insert_cart_stmt = $conn->prepare($insert_cart_sql);
        $insert_cart_stmt->bind_param("i", $userID);
        $insert_cart_stmt->execute();
        $cartID = $insert_cart_stmt->insert_id;
        $insert_cart_stmt->close();
    }
    $stmt->close();

    // Step 2: Check if product (with the same size) is already in the cart
    $check_sql = "SELECT cartItemID, quantity FROM cart_items WHERE cartID = ? AND productID = ? AND size = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("iis", $cartID, $product_id, $size);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // If product exists, update quantity
        $stmt->bind_result($cartItemID, $existing_quantity);
        $stmt->fetch();
        $new_quantity = $existing_quantity + $quantity;
        $update_sql = "UPDATE cart_items SET quantity = ? WHERE cartItemID = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $new_quantity, $cartItemID);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        // Insert new product into cart_items
        $insert_sql = "INSERT INTO cart_items (cartID, productID, quantity, size) VALUES (?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iiis", $cartID, $product_id, $quantity, $size);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    $stmt->close();
}

?>
