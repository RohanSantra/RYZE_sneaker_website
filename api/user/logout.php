<?php

include($_SERVER['DOCUMENT_ROOT'] . "/RYZE/includes/config.php");

// Destroy the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Redirect user to the login page after logout
header("Location: ../../public/Login_Signup.php");
exit();
?>
