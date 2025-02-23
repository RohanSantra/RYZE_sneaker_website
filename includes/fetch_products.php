<?php

require_once __DIR__ . "/init.php";

// Default SQL query
$sql = "SELECT * FROM products";

// Initialize an empty result
$result = null;

// Determine the request method and handle category filtering
$selectedCategory = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category'])) {
    $selectedCategory = $_POST['category'];
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];
}

// Filter products by category if a valid category is provided
if ($selectedCategory && $selectedCategory !== "All") {
    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    if ($stmt) {
        $stmt->bind_param("s", $selectedCategory);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    } else {
        die("Error preparing the SQL statement: " . $conn->error);
    }
} else {
    // Fetch all products if no category is selected
    $result = $conn->query($sql);
}


// Return filtered products as HTML
if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        echo '<div class="product" data-ID="'.htmlspecialchars($product['product_id']).'">
                    <div class="product-image-container">
                        <img src="../assets/images/products_bg/' . htmlspecialchars($product['product_image']) . '" class="product-image" alt="' . htmlspecialchars($product['product_image']) . '">
                    </div>

                    <div class="product-category ' . strtolower(htmlspecialchars($product['category'])) . '">
                        <span>Category : </span>
                        <span class="'.ucfirst(htmlspecialchars($product['category'])).'" >' . ucfirst(htmlspecialchars($product['category'])) . '</span>
                    </div>

                    <div class="product-name">
                        ' . htmlspecialchars($product['name']) . '
                    </div>

                    <div class="product-price">
                        &#8377;' . number_format($product['price'], 2) . '
                    </div>

                    <div class="product-size-quantiy-container">
                        <div class="product-size-container">
                            <select class="product-size">';
        // Generate sizes based on category
        $sizes = [];
        if (strtolower($product['category']) === "men") {
            $sizes = ["UK 6", "UK 7", "UK 8", "UK 9", "10", "UK 11", "UK 12"];
        } elseif (strtolower($product['category']) === "women") {
            $sizes = ["UK 4", "UK 5", "UK 6", "UK 7", "UK 8"];
        } elseif (strtolower($product['category']) === "kids") {
            $sizes = ["UK 1", "UK 2", "UK 3", "UK 4", "UK 5"];
        }

        foreach ($sizes as $size) {
            echo '<option value="' . htmlspecialchars($size) . '">' . htmlspecialchars($size) . '</option>';
        }

        echo '          </select>
                        </div>
                        <div class="product-quantity-container">
                            <button class="minus-number">&minus;</button>
                            <input type="number" min="1" max="5" value="1" class="number">
                            <button class="add-number">&plus;</button>
                        </div>
                    </div>
                    <button class="add-to-cart-button" data-product-id="'.htmlspecialchars($product['product_id']).'">
                        <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                    </button>
                </div>';
    }
} else {
    echo '<p>No products found for this category.</p>';
}


