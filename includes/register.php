<?php
include 'config.php';
if(isset($_POST['signup-btn'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $checkEmail="SELECT * from user_data WHERE email='$email'";
    $result=$conn->query($checkEmail);

    if($result->num_rows>0){
        echo "Email Address Already exists!";
    }
    else{
        $insertQuery="INSERT into user_data(username,email,password) values ('$username','$email','$password')";
        if($conn->query($insertQuery)==TRUE){
            header("Location: ../public/Ryze.html");
        }
        else{
            echo "Error: " . $conn->error;
        }
    }
}

if(isset($_POST['login-btn'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $sql="SELECT * from user_data WHERE email='$email' and password='$password'";    
    $result=$conn->query($sql);
    if($result->num_rows>0){
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['email']=$row['email'];
        header("Location: ../public/Ryze.html");
        exit();
    }
    else{
        echo "NOT found, Incorrect Email or password";
    }
}
?>
