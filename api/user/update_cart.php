<?php
include("../../includes/init.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cartItemID = $_POST["cartItemID"];
    $size = $_POST["size"];
    $quantity = (int)$_POST["quantity"];

    // Get the productID and cartID of the current item
    $query = $conn->prepare("SELECT productID, cartID FROM cart_items WHERE cartItemID = ?");
    $query->bind_param("i", $cartItemID);
    $query->execute();
    $query->bind_result($productID, $cartID);
    $query->fetch();
    $query->close();


    // Check if another cart item with the same productID and size exists in the cart
    $checkQuery = $conn->prepare("SELECT cartItemID, quantity FROM cart_items WHERE cartID = ? AND productID = ? AND size = ? AND cartItemID != ?");
    $checkQuery->bind_param("iisi", $cartID, $productID, $size, $cartItemID);
    $checkQuery->execute();
    $checkQuery->bind_result($existingCartItemID, $existingQuantity);
    $itemExists = $checkQuery->fetch();
    $checkQuery->close();

    if ($itemExists) {
        // Merge the items by updating quantity and deleting duplicate entry
        $newQuantity = $existingQuantity + $quantity;

        $updateQuery = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE cartItemID = ?");
        $updateQuery->bind_param("ii", $newQuantity, $existingCartItemID);
        $updateQuery->execute();
        $updateQuery->close();

        // Delete the original cart item since it's now merged
        $deleteQuery = $conn->prepare("DELETE FROM cart_items WHERE cartItemID = ?");
        $deleteQuery->bind_param("i", $cartItemID);
        $deleteQuery->execute();
        $deleteQuery->close();
        
    } else {
        // Update the existing cart item with the new size and quantity
        $updateQuery = $conn->prepare("UPDATE cart_items SET size = ?, quantity = ? WHERE cartItemID = ?");
        $updateQuery->bind_param("sii", $size, $quantity, $cartItemID);
        $updateQuery->execute();
        $updateQuery->close();
        
    }
}



?>

