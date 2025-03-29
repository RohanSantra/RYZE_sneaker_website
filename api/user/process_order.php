<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
ini_set('error_log', '/path/to/php-error.log'); // Log errors to a file

include("../../includes/init.php");

header("Content-Type: application/json");

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit;
}

$userID = $_SESSION['userID'];

// Validate request method
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
    exit;
}

// Decode JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (!isset($data['orderID'], $data['totalAmount'], $data['paymentMethod'], $data['shippingCharges'])) {
    echo json_encode(["success" => false, "message" => "Missing required fields."]);
    exit;
}

$orderID = $data['orderID'];
$totalAmount = floatval($data['totalAmount']);
$paymentMethod = $data['paymentMethod'];
$shippingCharges = floatval($data['shippingCharges']);

$totalAmountBeforeShipping=$totalAmount-$shippingCharges;

try {
    // Fetch Address ID
    $stmt = $conn->prepare("SELECT address_id FROM shipping_address WHERE userID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo json_encode(["success" => false, "message" => "Shipping address not found."]);
        exit;
    }

    $addressID = $row['address_id']; // Corrected column name
    $orderDate = date("Y-m-d");
    $deliveryDate = date("Y-m-d", strtotime($orderDate . ($shippingCharges == 100 ? " +3 days" : " +5 days")));

    // Start Transaction
    $conn->begin_transaction();

    // Insert into Orders Table
    $stmt = $conn->prepare("INSERT INTO orders (orderID, userID, orderDate, deliveryDate, totalAmountBeforeShipping, shippingCharges, totalAmountWithShipping, status, paymentMethod, addressID) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', ?, ?)");
    $stmt->bind_param("sissdddss", $orderID, $userID, $orderDate, $deliveryDate, $totalAmountBeforeShipping, $shippingCharges, $totalAmount, $paymentMethod, $addressID);
    $stmt->execute();

    // Fetch Cart ID for the User
    $stmt = $conn->prepare("SELECT cartID FROM carts WHERE userID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $cartResult = $stmt->get_result();
    $cartRow = $cartResult->fetch_assoc();

    if (!$cartRow) {
        echo json_encode(["success" => false, "message" => "Cart not found for the user."]);
        exit;
    }

    $cartID = $cartRow['cartID'];

    // Move Cart Items to Order_Items Table
    $stmt = $conn->prepare("SELECT productID, quantity, size FROM cart_items WHERE cartID = ?");
    $stmt->bind_param("i", $cartID);
    $stmt->execute();
    $cartItems = $stmt->get_result();

    while ($item = $cartItems->fetch_assoc()) {
        // Insert into order_items
        $stmt = $conn->prepare("INSERT INTO order_items (orderID, productID, quantity, size) 
                                VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siis", $orderID, $item['productID'], $item['quantity'], $item['size']);
        $stmt->execute();
    }

    // Delete Cart Items
    $stmt = $conn->prepare("DELETE FROM cart_items WHERE cartID = ?");
    $stmt->bind_param("i", $cartID);
    $stmt->execute();

    // Delete Cart
    $stmt = $conn->prepare("DELETE FROM carts WHERE cartID = ?");
    $stmt->bind_param("i", $cartID);
    $stmt->execute();

    // Commit Transaction
    $conn->commit();

    echo json_encode(["success" => true, "message" => "Order placed successfully."]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(["success" => false, "message" => "Failed to place order.", "error" => $e->getMessage()]);
}
?>