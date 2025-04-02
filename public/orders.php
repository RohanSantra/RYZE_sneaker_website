<?php
include("../includes/init.php");

$userID=$_SESSION['userID'];


// Fetch orders and their items
$orders = [];
$stmt = $conn->prepare("
    SELECT o.orderID, o.orderDate, o.deliveryDate, o.totalAmountBeforeShipping, o.shippingCharges, 
           o.totalAmountWithShipping, o.status, o.paymentMethod, o.addressID,
           oi.orderItemID, oi.productID, oi.quantity, oi.size, 
           p.name, p.product_image, p.category
    FROM orders o
    JOIN order_items oi ON o.orderID = oi.orderID
    JOIN products p ON oi.productID = p.product_id
    WHERE o.userID = ?
    ORDER BY o.orderDate DESC
");
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

// Organize orders and their items
while ($row = $result->fetch_assoc()) {
    $orderID = $row['orderID'];
    if (!isset($orders[$orderID])) {
        $orders[$orderID] = [
            'orderID' => $orderID,
            'orderDate' => $row['orderDate'],
            'deliveryDate' => $row['deliveryDate'],
            'totalAmountBeforeShipping' => $row['totalAmountBeforeShipping'],
            'shippingCharges' => $row['shippingCharges'],
            'totalAmountWithShipping' => $row['totalAmountWithShipping'],
            'status' => $row['status'],
            'paymentMethod' => $row['paymentMethod'],
            'addressID' => $row['addressID'],
            'items' => []
        ];
    }
    $orders[$orderID]['items'][] = [
        'orderItemID' => $row['orderItemID'],
        'productID' => $row['productID'],
        'name' => $row['name'],
        'product_image' => $row['product_image'],
        'category'=>$row['category'],
        'quantity' => $row['quantity'],
        'size' => $row['size']
    ];
}
$stmt->close();
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

    <!------------------- Links for styles ---------------->
    <link rel="stylesheet" href="../assets/css/header.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/orders.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/footer.css?v=<?= $version ?>">

</head>

<body>
    <!-- Header Section -->
    <?php include("../includes/header.php"); ?>

    <div class="order-section">
        <?php if (empty($orders)): ?>
            <p>No orders found.</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <!-- Order Container -->
                <div class="order-container">
                    <div class="order-details">
                        <div class="order-date">
                            <h3>Order Placed :</h3>
                            <span class="date"><?= date("F j, Y", strtotime($order['orderDate'])) ?></span>
                        </div>
                        <div class="order-price">
                            <h3>Order Total Price :</h3>
                            <span class="price">&#8377;<?= number_format($order['totalAmountWithShipping'], 2) ?></span>
                        </div>
                        <div class="order-id">
                            <h3>Order ID :</h3>
                            <span class="id"><?= $order['orderID'] ?></span>
                        </div>
                        <a href="order_details.php<?php echo '?orderID=' . $order['orderID']; ?>" class="view-order"><i class='bx bx-shopping-bag'></i> View Order</a>
                    </div>

                    <!-- Order Items -->
                    <?php foreach ($order['items'] as $item): ?>
                        <div class="order-item">
                            <div class="product-image">
                                <img src="../assets/images/products_bg/<?= $item['product_image'] ?>" alt="<?= $item['name'] ?>">
                            </div>
                            <div class="product-info">
                                <div class="product-name"><?= $item['name'] ?></div>
                                <div class="product-category">
                                    <span>Category: </span>
                                    <span class="<?php echo htmlspecialchars($item['category']); ?>">
                                        <?php echo htmlspecialchars($item['category']); ?>
                                    </span>
                                </div>
                                <div class="product-size-quantity-container">
                                    <span>Size : <?= $item['size'] ?></span>
                                    <span>Quantity : <?= $item['quantity'] ?></span>
                                </div>
                            </div>
                            <div class="product-links">
                                <button class="buy-again" data-product-id="<?php echo $item['productID']; ?>" data-product-size="<?php echo $item['size']; ?>" 
                                    data-product-quantity="<?php echo $item['quantity']; ?>">
                                    <img src="../assets/images/icons/buy-again.png"  alt="buy-again"> Buy It Again
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!------------------- Links for script ---------------->
    <script type="module" src="../assets/js/header.js?v=<?= $version ?>"></script>
    <script type="module" src="../assets/js/order.js?v=<?= $version ?>"></script>
</body>

</html>