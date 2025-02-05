<?php
require_once __DIR__ . "../../includes/init.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ryze</title>

    <!------------------- Links for icons ---------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!------------------- Links for styles ---------------->
    <link rel="stylesheet" href="../assets/css/Login_signin.css?v=<?= $version ?>">
</head>

<body>
<div class="container">
        <div class="form-box login">
            <form action="../api/user/LoginValidate.php" method="post">
                <h1>Login</h1>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-github"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <p>or use your email password</p>
                <div class="input-box">
                    <input type="email" placeholder="Email" name="Email" id="email" required>
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="Password" id="password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="error-message">
                    <?php
                    if (isset($_SESSION['loginError'])) {
                        echo "<p style='color: red;'>" . htmlspecialchars($_SESSION['loginError']) . "</p>";
                        unset($_SESSION['loginError']); // Clear the error after displaying
                    }
                    // if (isset($_SESSION['loginSuccess'])) {
                    //     echo "<p style='color: green;'>" . htmlspecialchars($_SESSION['loginSuccess']) . "</p>";
                    //     unset($_SESSION['loginSuccess']); // Clear the success message after displaying
                    // }
                    ?>
                </div>
                <div class="forgot-link">
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" name="Login-btn" class="btn">Login</button>
            </form>
        </div>

        <div class="form-box signup">
            <form action="../api/user/SignupValidate.php" method="post">
                <h1>Sign Up</h1>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-github"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <p>or use your email for registration</p>
                <div class="input-box">
                    <input type="text" placeholder="Username" name="Username" id="username" required>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="input-box">
                    <input type="email" placeholder="Email" name="Email" id="signup-email" required>
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="Password" id="signup-password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="error-message">
                    <?php
                    if (isset($_SESSION['SignUpError'])) {
                        echo "<p style='color: red;'>" . htmlspecialchars($_SESSION['SignUpError']) . "</p>";
                        unset($_SESSION['SignUpError']); // Clear the error after displaying
                    }
                    // if (isset($_SESSION['SignUpSuccess'])) {
                    //     echo "<p style='color: green;'>" . htmlspecialchars($_SESSION['SignUpSuccess']) . "</p>";
                    //     unset($_SESSION['SignUpSuccess']); // Clear the success message after displaying
                    // }
                    ?>
                </div>
                <button type="submit" name="Signup-btn" class="btn">Sign Up</button>
            </form>
        </div>
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't Have an account?</p>
                <button class="btn signup-btn">sign Up</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>
    <script src="../assets/js/Login_signin.js?v=<?= $version ?>"></script>
</body>

</html>