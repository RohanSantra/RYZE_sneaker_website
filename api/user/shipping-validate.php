<?php
include("../../includes/init.php"); 

$userID = $_SESSION['userID'];


$firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
$lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$state = isset($_POST['state']) ? trim($_POST['state']) : '';
$city = isset($_POST['city']) ? trim($_POST['city']) : '';
$postalCode = isset($_POST['postalCode']) ? trim($_POST['postalCode']) : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';


// Update user email
$updateUserQuery = $conn->prepare("UPDATE users SET email = ? WHERE userID = ?");
$updateUserQuery->bind_param("si", $email, $userID);
$updateUserQuery->execute();
$updateUserQuery->close();


// Check if shipping address exists
$checkAddressQuery = $conn->prepare("SELECT * FROM shipping_address WHERE userID = ?");
$checkAddressQuery->bind_param("i", $userID);
$checkAddressQuery->execute();
$checkAddressResult = $checkAddressQuery->get_result();
$checkAddressQuery->close();

// Update or Insert Shipping Address
if ($checkAddressResult->num_rows > 0) {
    // Update existing address
    $updateAddressQuery = $conn->prepare("UPDATE shipping_address SET first_name = ?, last_name = ?, phone = ?, state = ?, city = ?, postal_code = ?, address = ? WHERE userID = ?");
    $updateAddressQuery->bind_param("sssssssi", $firstName, $lastName, $phone, $state, $city, $postalCode, $address, $userID);
    $updateAddressQuery->execute();
    $updateAddressQuery->close();
} else {
    // Insert new address
    $insertAddressQuery = $conn->prepare("INSERT INTO shipping_address (userID, first_name, last_name, phone, state, city, postal_code, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $insertAddressQuery->bind_param("isssssss", $userID, $firstName, $lastName, $phone, $state, $city, $postalCode, $address);
    $insertAddressQuery->execute();
    $l->close();
}

header("Location: ../../public/checkout/Shipping.php");
exit();

?>