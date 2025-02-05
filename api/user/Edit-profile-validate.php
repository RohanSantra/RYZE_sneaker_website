<?php
include("../../includes/config.php");  // Include database connection

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    die("User not logged in. Please log in to update your profile.");
}

$userID = $_SESSION['userID'];

// Retrieve existing image (in case no new image is uploaded)
$getImageQuery = $conn->prepare("SELECT image FROM users WHERE userID = ?");
$getImageQuery->bind_param("i", $userID);
$getImageQuery->execute();
$getImageResult = $getImageQuery->get_result();
$existingImage = $getImageResult->fetch_assoc()['image'];
$getImageQuery->close();

// Sanitize & Retrieve Form Data
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
$lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$state = isset($_POST['state']) ? trim($_POST['state']) : '';
$city = isset($_POST['city']) ? trim($_POST['city']) : '';
$postalCode = isset($_POST['postalCode']) ? trim($_POST['postalCode']) : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';

// Validate required fields
// if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($state) || empty($city) || empty($postalCode) || empty($address)) {
//     die("All fields are required.");
// }

// Update user email
$updateUserQuery = $conn->prepare("UPDATE users SET email = ?, username = ? WHERE userID = ?");
$updateUserQuery->bind_param("ssi", $email, $username, $userID);
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

if (!empty($_FILES['profileImage']['name'])) {
    // Check for upload errors
    if ($_FILES['profileImage']['error'] !== UPLOAD_ERR_OK) {
        die("Error uploading file: " . $_FILES['profileImage']['error']);
    }

    $image = $_FILES['profileImage']['name'];
    $image_size = $_FILES['profileImage']['size'];
    $image_tmp_name = $_FILES['profileImage']['tmp_name'];
    $image_folder = '../../assets/images/uploaded_img/' . $image;

    // Validate file extension
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $image_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    if (!in_array($image_extension, $allowed_extensions)) {
        die("Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.");
    }

    // Validate file size (Max 2MB)
    if ($image_size > 20 * 1024 * 1024) {
        die("Image size must be less than 2MB.");
    }

    // Move uploaded file
    if (move_uploaded_file($image_tmp_name, $image_folder)) {
        // Update image in database
        $updateImageQuery = $conn->prepare("UPDATE users SET image = ? WHERE userID = ?");
        $updateImageQuery->bind_param("si", $image, $userID);
        if (!$updateImageQuery->execute()) {
            die("Database update error: " . $conn->error);
        }
        $updateImageQuery->close();
    } else {
        die("Failed to move uploaded file.");
    }
}


// Redirect to profile page with success message
header("Location: ../../public/profile.php?update=success");
exit();
?>
