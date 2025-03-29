<?php
include("../includes/init.php");

$userID=$_SESSION['userID'];

// Get orderID from the URL
$orderID = $_GET['orderID'] ?? null;
if (!$orderID) {
    die("Order ID not provided.");
}

// Fetch order details
$stmt = $conn->prepare("
    SELECT o.orderID, o.orderDate, o.deliveryDate, o.totalAmountBeforeShipping, o.ShippingCharges ,o.totalAmountWithShipping, o.status, o.paymentMethod,
           oi.productID, oi.quantity, oi.size, 
           p.name, p.product_image, p.category,p.price
    FROM orders o
    JOIN order_items oi ON o.orderID = oi.orderID
    JOIN products p ON oi.productID = p.product_id
    WHERE o.orderID = ?
");
$stmt->bind_param("s", $orderID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Order not found.");
}

$order = [];
while ($row = $result->fetch_assoc()) {
    if (empty($order)) {
        $order = [
            'orderID' => $row['orderID'],
            'orderDate' => $row['orderDate'],
            'deliveryDate' => $row['deliveryDate'],
            'totalAmountBeforeShipping'=>$row['totalAmountBeforeShipping'],
            'ShippingCharges'=>$row['ShippingCharges'],
            'totalAmountWithShipping' => $row['totalAmountWithShipping'],
            'status' => $row['status'],
            'paymentMethod' => $row['paymentMethod'],
            'items' => []
        ];
    }
    $order['items'][] = [
        'productID' => $row['productID'],
        'name' => $row['name'],
        'product_image' => $row['product_image'],
        'category' => $row['category'],
        'quantity' => $row['quantity'],
        'size' => $row['size'],
        'price'=>$row['price']
    ];
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Ryze</title>

    <!------------------- Links for icons ---------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!------------------- Links for styles ---------------->
    <link rel="stylesheet" href="../assets/css/header.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/order_details.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/footer.css?v=<?= $version ?>">
</head>

<body>
    <!-- Header Section -->
    <?php include("../includes/header.php"); ?>

    <div class="order-details-container">
        <div class="order-header">
            <h1>Order Details</h1>
            <p class="order-date">Order Placed : <?= date("F j, Y", strtotime($order['orderDate'])) ?></p>
            <p class="order-date">Delivery Date : <?= date("F j, Y", strtotime($order['deliveryDate'])) ?></p>
        </div>

        <!-- Order Status -->
        <div class="order-status">
            <h2>Order Status</h2>
            <div class="status-steps">
                <div class="step <?= $order['status'] === 'Pending'||$order['status'] === 'Processing'||$order['status'] === 'Shipped'||$order['status'] === 'Delivered' ? 'active' : '' ?>">
                    <span>Pending</span>
                </div>
                <div class="step <?= $order['status'] === 'Processing'||$order['status'] === 'Shipped'||$order['status'] === 'Delivered' ? 'active' : '' ?>">
                    <span>Processing</span>
                </div>
                <div class="step <?= $order['status'] === 'Shipped'||$order['status'] === 'Delivered' ? 'active' : '' ?>">
                    <span>Shipped</span>
                </div>
                <div class="step <?= $order['status'] === 'Delivered' ? 'active' : '' ?>">
                    <span>Delivered</span>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="order-container">
            <div class="order-items">
                <h2>Order Items</h2>
                <?php foreach ($order['items'] as $item): ?>
                    <div class="order-item">
                        <div class="product-image">
                            <img src="../assets/images/products_bg/<?= $item['product_image'] ?>" alt="<?= $item['name'] ?>">
                        </div>
                        <div class="product-info">
                            <h3><?= $item['name'] ?></h3>
                            <p>Category: <span class="<?= $item['category'] ?>"><?= $item['category'] ?></span></p>
                            <p>Size: <?= $item['size'] ?></p>
                            <p>Quantity: <?= $item['quantity'] ?></p>
                            <p>&#8377;<?= $item['price'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Payment Details -->
            <div class="payment-details">
                <h1>Payment Details</h1>
                <div class="summary-row line">
                    <div>Subtotal:</div>
                    <div class="summary-amount">&#8377;<?= number_format($order['totalAmountBeforeShipping'], 2) ?></div>
                </div>
                <div class="summary-row">
                    <div>Shipping:</div>
                    <div class="summary-amount">&#8377;<?= number_format($order['ShippingCharges'], 2) ?></div>
                </div>
                <div class="summary-row line">
                    <div>Total:</div>
                    <div class="summary-amount total-amount">&#8377;<?= number_format($order['totalAmountWithShipping'], 2) ?></div>
                </div>
            </div>
        </div>   
    </div>

    <!------------------- Links for script ---------------->
    <script type="module" src="../assets/js/header.js?v=<?= $version ?>"></script>
</body>

</html>