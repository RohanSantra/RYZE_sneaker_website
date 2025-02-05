<?php
include("../includes/config.php");  // Include database connection

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    die("User not logged in. Please log in to view your profile.");
}

// Get user ID from session
$userID = $_SESSION['userID'];
// echo $userID;

// Fetch user details
$user_query = $conn->prepare("SELECT username, email, image FROM users WHERE userID = ?");
$user_query->bind_param("i", $userID);
$user_query->execute();
$user_result = $user_query->get_result();
$user = $user_result->fetch_assoc() ?: ['username' => 'N/A', 'email' => 'N/A'];  // Default values if no data found

// Fetch shipping address
$address_query = $conn->prepare("SELECT first_name, last_name, phone, state, city, postal_code, address FROM shipping_address WHERE userID = ?");
$address_query->bind_param("i", $userID);
$address_query->execute();
$address_result = $address_query->get_result();
$address = $address_result->fetch_assoc() ?: ['first_name' => 'N/A', 'last_name' => 'N/A', 'phone' => 'N/A', 'state' => 'N/A', 'city' => 'N/A', 'postal_code' => 'N/A', 'address' => 'N/A'];  // Default values if no data found

$user_query->close();
$address_query->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ryze</title>

    <!-- Links for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../assets/css/profile.css?v=<?= time() ?>">

</head>
<body>

<div class="navigator">
    <a href="Ryze.php"><i class='bx bx-caret-left'></i><span>BACK TO HOME PAGE</span></a>
</div>

<div class="profile-section">
    <div class="profile-container">
        <h2 class="profile-text"><i class='bx bx-user'></i> Profile</h2>

        <div class="profile-sidebar">
            <div class="profile-img">
                <?php
                // Display profile image (default if none is set)
                $profileImage = !empty($user['image']) ? "../assets/images/uploaded_img/{$user['image']}" : "../assets/images/icons/default-avatar.png";
                echo '<img id="profileImage" src="' . htmlspecialchars($profileImage) . '" alt="Profile Picture">';
                ?>
            </div>
            <h2><?= htmlspecialchars($user['username']) ?></h2>
            <p class="email"><?= htmlspecialchars($user['email']) ?></p>
            <p class="phone">📞 <?= htmlspecialchars($address['phone']) ?></p>
        </div>

        <div class="profile-details">
            <div class="info-box">
                <h3>Personal Details</h3>
                <p><strong>First Name:</strong> <?= htmlspecialchars($address['first_name']) ?></p>
                <p><strong>Last Name:</strong> <?= htmlspecialchars($address['last_name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($address['phone']) ?></p>
            </div>

            <div class="info-box">
                <h3>Shipping Address</h3>
                <p><strong>State:</strong> <?= htmlspecialchars($address['state']) ?></p>
                <p><strong>City:</strong> <?= htmlspecialchars($address['city']) ?></p>
                <p><strong>Postal Code:</strong> <?= htmlspecialchars($address['postal_code']) ?></p>
                <p><strong>Address:</strong> <?= htmlspecialchars($address['address']) ?></p>
            </div>

            <div class="profile-actions">
                <a href="Edit-profile.php" class="edit-btn"><i class='bx bx-edit-alt'></i> Edit Profile</a>
                <a href="../api/user/logout.php" class="logout-btn"><i class='bx bx-door-open'></i> Logout</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
