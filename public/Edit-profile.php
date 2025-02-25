<?php
include("../includes/config.php");  // Include database connection

// Get user ID from session
$userID = $_SESSION['userID'];

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
$address = $address_result->fetch_assoc() ?: ['first_name' => '', 'last_name' => '', 'phone' => '', 'state' => '', 'city' => '', 'postal_code' => '', 'address' => ''];  // Default empty values

$user_query->close();
$address_query->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ryze - Edit Profile</title>

    <!-- Links for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../assets/css/Edit-profile.css?v=<?= time() ?>">
</head>
<body>

<div class="navigator">
    <a href="profile.php"><i class='bx bx-caret-left'></i><span>BACK TO PROFILE</span></a>
</div>

<div class="edit-profile-section">
    <div class="edit-profile-container">
        <!-- Edit Profile Form -->
        <form action="../api/user/Edit-profile-validate.php" method="POST" enctype="multipart/form-data">
            <div class="profile-img-box">
                <h2><i class='bx bx-edit-alt'></i> Edit Profile</h2>
                <?php
                $profileImage = !empty($user['image']) ? "../assets/images/uploaded_img/{$user['image']}" : "../assets/images/icons/default-avatar.png";
                echo '<img id="profileImage" src="' . htmlspecialchars($profileImage) . '" alt="Profile Picture">';
                ?>
                <input type="file" id="imageUpload" name="profileImage" accept="image/*">
                <label for="imageUpload">Change Profile Picture</label>
            </div>

            <div class="form-grid">
                <div class="input-box">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                </div>

                <div class="input-box">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" value="<?= htmlspecialchars($address['first_name']) ?>" required>
                </div>

                <div class="input-box">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" value="<?= htmlspecialchars($address['last_name']) ?>" required>
                </div>

                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                <div class="input-box">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($address['phone']) ?>" required>
                </div>

                <div class="input-box">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" value="<?= htmlspecialchars($address['state']) ?>" required>
                </div>

                <div class="input-box">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" value="<?= htmlspecialchars($address['city']) ?>" required>
                </div>

                <div class="input-box">
                    <label for="postalCode">Postal Code</label>
                    <input type="text" id="postalCode" name="postalCode" value="<?= htmlspecialchars($address['postal_code']) ?>" required>
                </div>

                <div class="input-box">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" required><?= htmlspecialchars($address['address']) ?></textarea>
                </div>

                <button type="submit" class="save-btn">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script src="../assets/js/Edit-profile.js?v=<?= time() ?>"></script>

</body>
</html>
