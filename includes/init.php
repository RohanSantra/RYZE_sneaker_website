<?php


// Include database connection
require_once __DIR__ . "/config.php";


// Include necessary functions 
require_once __DIR__ . "../../api/user/LoginValidate.php";
require_once __DIR__ . "../../api/user/SignupValidate.php";


// Check if user is logged in

$is_logged_in = isset($_SESSION['userID']);

// Set username if logged in, or leave empty
$username = $is_logged_in && isset($_SESSION['username']) ? $_SESSION['username'] : '';


?>