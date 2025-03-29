<?php
include("../../includes/init.php");
$userID = $_SESSION['userID'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION['userID']; // Get userID from session
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $uploadedFile = "";

    // File Upload
    if (!empty($_FILES['upload']['name'])) {
        $targetDir = "../../assets/images/contact_file_upload/";
        $uploadedFile = basename($_FILES['upload']['name']);
        $targetFile = $targetDir . $uploadedFile;
        move_uploaded_file($_FILES['upload']['tmp_name'], $targetFile);
    }

    $stmt = $conn->prepare("INSERT INTO feedback (userID, name, email, phone, message, uploaded_file) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $userID, $name, $email, $phone, $message, $uploadedFile);

    if ($stmt->execute()) {
        echo "<script>alert('Message Sent Successfully!'); window.location.href='../../public/Contact.php';</script>";
    } else {
        echo "<script>alert('Failed to Send Message!'); window.location.href='Contact.php';</script>";
    }
}
?>
