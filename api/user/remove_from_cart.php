<?php
include("../../includes/init.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cartItemID = $_POST["cartItemID"];

    // Delete the cart item
    $deleteQuery = $conn->prepare("DELETE FROM cart_items WHERE cartItemID = ?");
    $deleteQuery->bind_param("i", $cartItemID);
    $deleteQuery->execute();
    $deleteQuery->close();
}
?>
