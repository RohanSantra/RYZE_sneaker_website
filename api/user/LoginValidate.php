<?php

include($_SERVER['DOCUMENT_ROOT'] . "/RYZE/includes/config.php");




// Validate email
function validateEmailForLogin($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }
    return '';
}

// Validate password
function validatePasswordForLogin($password)
{
    if (empty($password)) {
        return "Password cannot be empty.";
    }
    return '';
}

// Authenticate user credentials
function authenticateUser($email, $password, $conn)
{
    // Prepare the SQL query to fetch user data
    $stmt = $conn->prepare("SELECT userID, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); // Bind the email parameter
    $stmt->execute(); // Execute the query
    $stmt->store_result(); // Store the result

    // Check if a user with the provided email exists
    if ($stmt->num_rows > 0) {
        // Bind the result to variables
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['userID'] = $id;
            $_SESSION['username'] = $username;

            // Redirect to the dashboard or desired page
            header("Location: ../../public/Ryze.php");
            exit();
        } else {
            // Incorrect password
            $_SESSION['loginError'] = "Invalid password.";
        }
    } else {
        // No account found with the provided email
        $_SESSION['loginError'] = "No account found with this email.";
    }

    // Close the prepared statement
    $stmt->close();

    // Redirect back to the login page if there was an error
    header("Location: ../../public/Login_Signup.php");
    exit();
}


function handleLogin($email, $password, $conn)
{
    // Validate email
    $loginError = validateEmailForLogin($email);
    if ($loginError) {
        $_SESSION['loginError'] = $loginError;
        header("Location: ../../public/Login_Signup.php");
        exit();
    }

    // Validate password
    $loginError = validatePasswordForLogin($password);
    if ($loginError) {
        $_SESSION['loginError'] = $loginError;
        header("Location: ../../public/Login_Signup.php");
        exit();
    }

    // Authenticate user
    authenticateUser($email, $password, $conn);
}

// Check for POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Login-btn'])) {
        $email = trim($_POST['Email']);
        $password = trim($_POST['Password']);
        handleLogin($email, $password, $conn);
    }
}

?>
