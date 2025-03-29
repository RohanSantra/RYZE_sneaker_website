<?php
include('./init.php');

header('Content-Type: application/json'); // Set the content type to JSON

if (isset($_SESSION['userID'])) {
    echo json_encode(['userID' => $_SESSION['userID']]);
} else {
    echo json_encode(['userID' => null]);
}
?>
