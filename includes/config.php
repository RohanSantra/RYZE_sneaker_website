<?php

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// // Ensure session contains user data
// $_SESSION['userID'] = $_SESSION['userID'] ; // Example user ID

// Check if session data is empty
if (empty($_SESSION)) {
    $_SESSION['message'] = 'Session is empty, no data to store';
}

// Get session ID and serialize session data
$session_id = session_id();
$session_data = serialize($_SESSION);
if (empty($session_data)) {
    $session_data = 'No session data available';
}

// Prevent browser caching issues
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2026 00:00:00 GMT");
$version = time(); // Version control for cache busting

// Database Configuration
$DB_SERVER = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'ryze';
$DB_PORT = 3307;

// Create a database connection
$conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME, $DB_PORT);
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Oops! Something went wrong. Please try again later.");
}

//Inserting session information
// $stmt = $conn->prepare("REPLACE INTO sessions (session_id, user_id, session_data, last_access) VALUES (?, ?, ?, NOW())");
// $stmt->bind_param("sis", $session_id, $user_id, $session_data);
// $stmt->execute();
// $stmt->close();

// Define session handler functions if not already defined
if (!function_exists('openSession')) {
    function openSession($savePath, $sessionName) {
        return true;
    }
    
    function closeSession() {
        return true;
    }
    
    function readSession($session_id) {
        global $conn;
        $stmt = $conn->prepare("SELECT session_data FROM sessions WHERE session_id = ?");
        $stmt->bind_param("s", $session_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($session_data);
        return $stmt->fetch() ? $session_data : "";
    }
    
    function writeSession($session_id, $session_data) {
        global $conn;
        $user_id = $_SESSION['userID'] ?? NULL;
        $stmt = $conn->prepare("REPLACE INTO sessions (session_id, user_id, session_data, last_access) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sis", $session_id, $user_id, $session_data);
        return $stmt->execute();
    }
    
    function destroySession($session_id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM sessions WHERE session_id = ?");
        $stmt->bind_param("s", $session_id);
        return $stmt->execute();
    }
    
    function gcSession($maxlifetime) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM sessions WHERE last_access < NOW() - INTERVAL ? SECOND");
        $stmt->bind_param("i", $maxlifetime);
        return $stmt->execute();
    }
}

// Set custom session handlers if session not already started
if (session_status() === PHP_SESSION_NONE) {
    session_set_save_handler(
        "openSession",
        "closeSession",
        "readSession",
        "writeSession",
        "destroySession",
        "gcSession"
    );
    session_start();
}

?>
