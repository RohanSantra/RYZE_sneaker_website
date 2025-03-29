<?php
include($_SERVER['DOCUMENT_ROOT'] . "/RYZE/includes/config.php");

// Validate Email
function validateEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }
    return '';
}

// Validate Password
function validatePassword($password, $confirmPassword)
{
    if (empty($password)) {
        return "Password cannot be empty.";
    }
    if ($password !== $confirmPassword) {
        return "Passwords do not match.";
    }
    return '';
}

// Check if email exists and fetch user data
function checkEmail($email, $conn)
{
    $stmt = $conn->prepare("SELECT userID, username FROM users WHERE email = ?");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userID, $username);
        $stmt->fetch();
        $_SESSION['userID'] = $userID;
        $_SESSION['username'] = $username;
        $stmt->close();
        return true;
    }
    
    $stmt->close();
    return false;
}

// Update Password
function updatePassword($email, $newPassword, $conn)
{
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    if (!$stmt) {
        $_SESSION['passwordResetLoginError'] = "Failed to prepare statement.";
        header("Location: ../../public/Login_Signup.php");
        exit();
    }

    $stmt->bind_param("ss", $hashedPassword, $email);
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../../public/Ryze.php");
        exit();
    } else {
        $_SESSION['passwordResetLoginError'] = "Failed to update password.";
        $stmt->close();
        header("Location: ../../public/Login_Signup.php");
        exit();
    }
}

// Handle Password Reset
function handlePasswordReset($email, $newPassword, $confirmPassword, $conn)
{
    $error = validateEmail($email);
    if ($error) {
        $_SESSION['passwordResetLoginError'] = $error;
        header("Location: ../../public/Login_Signup.php");
        exit();
    }

    $error = validatePassword($newPassword, $confirmPassword);
    if ($error) {
        $_SESSION['passwordResetLoginError'] = $error;
        header("Location: ../../public/Login_Signup.php");
        exit();
    }

    if (!checkEmail($email, $conn)) {
        $_SESSION['passwordResetLoginError'] = "Email not found.";
        header("Location: ../../public/Login_Signup.php");
        exit();
    }

    updatePassword($email, $newPassword, $conn);
}

// Check for POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pass-res-btn'])) {
        $email = trim($_POST['Email']);
        $newPassword = trim($_POST['New_password']);
        $confirmPassword = trim($_POST['Confirm_password']);

        handlePasswordReset($email, $newPassword, $confirmPassword, $conn);
    }
}
?>
