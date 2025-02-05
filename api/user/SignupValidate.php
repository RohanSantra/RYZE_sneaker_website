<?php

include($_SERVER['DOCUMENT_ROOT'] . "/RYZE/includes/config.php");

// Checking if username is valid
function validateUsername($username)
{
    if (strlen($username) < 3 || strlen($username) > 20) {
        return "Username must be between 3 and 20 characters.";
    }
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        return "Username can only contain letters, numbers, and underscores.";
    }
    return '';
}

// Checking if password is valid
function validatePassword($password)
{
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must contain at least one uppercase letter.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        return "Password must contain at least one lowercase letter.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        return "Password must contain at least one digit.";
    }
    if (!preg_match('/[\W_]/', $password)) {
        return "Password must contain at least one special character.";
    }
    return '';
}

function validateEmail($email, $conn)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }
    // Check if the email already exists in the database
    $stmt = $conn->prepare("SELECT userID FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        return "This email is already registered.";
    }

    $stmt->close();
    return ''; // No errors
}

function insertUserData($username, $email, $password, $conn)
{
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password,email, dateCreated) VALUES (?, ?, ?, ?)");
    $date = date('Y-m-d H:i:s');
    $stmt->bind_param("ssss", $username, $hash_password, $email, $date);

    if ($stmt->execute()) {

        // Store user data in session
        $_SESSION['userID'] = $conn->insert_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        // $_SESSION['success'] = "Signup successful! You can now log in.";
        header("Location: ../../public/Ryze.php"); // Redirect to Home page
        exit();
    } else {
        $_SESSION['SignUpError'] = "Error: " . $stmt->error;
    }
    $stmt->close();
}

function handleSignup($username, $email, $password, $conn)
{
    // Validate fields
    $SignUpError = validateUsername($username);
    if ($SignUpError) {
        $_SESSION['SignUpError'] = $SignUpError;
        header("Location: ../../public/Login_Signup.php");
        exit();
    }

    $SignUpError = validateEmail($email, $conn);
    if ($SignUpError) {
        $_SESSION['SignUpError'] = $SignUpError;
        header("Location: ../../public/Login_Signup.php");
        exit();
    }

    $SignUpError = validatePassword($password);
    if ($SignUpError) {
        $_SESSION['SignUpError'] = $SignUpError;
        header("Location: ../../public/Login_Signup.php");
        exit();
    }

    // All validations passed; proceed to insert user data
    insertUserData($username, $email, $password, $conn);
}

// Check for POST request for signup
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Signup-btn'])) {
        $username = trim($_POST['Username']);
        $email = trim($_POST['Email']);
        $password = trim($_POST['Password']);
        handleSignup($username, $email, $password, $conn);
    }
}
