<?php
include("../includes/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ryze</title>

    <!------------------- Links for icons ---------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!------------------- Links for styles ---------------->
    <link rel="stylesheet" href="../assets/css/header.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/Contact.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/footer.css?v=<?= $version ?>">
</head>

<body>
    <!-- Header Section -->
    <?php
    include("../includes/header.php");
    ?>


    <!-- Contact section -->
    <section class="contact">
        <div class="contact-container">
            <div class="contact-image">
                <span>look at google map &RightArrow;</span>
                <span>Contact Us</span>
                <img src="../assets/images/Contact-image.jpg" alt="Contact-image">
            </div>
            <div class="contact-form">
                <h3>Feedback form</h3>
                <form>
                    <input type="text" id="name" name="name" placeholder="Name">
                    <input type="email" id="email" name="email" placeholder="E-mail">
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Phone" required>
                    <textarea id="message" name="message" placeholder="Message"></textarea>
                    <div class="upload-section">
                        <label for="upload" class="label"><i class='bx bx-cloud-upload'></i>Upload file</label>
                        <input type="file" id="upload" name="upload" placeholder="" accept="image/*,.pdf,.doc" multiple>
                    </div>
                    <button type="Submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer section -->
    <footer>
        <div class="container">
            <!-- Column 1: Branding & About -->
            <div class="column">
                <h2>About Us</h2>
                <p>RYZE is committed to elevating your game, offering unmatched content, and providing opportunities to
                    connect
                    and grow.</p>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="column">
                <h2>Quick Links</h2>
                <ul class="anchor-links">
                    <li><a href="Policies.html">Policies</a></li>
                    <li><a href="About.html">About</a></li>
                    <li><a href="FAQ.html">FAQ</a></li>
                    <li><a href="Contact.html">Contact</a></li>
                </ul>
            </div>

            <!-- Column 3: Newsletter -->
            <div class="column">
                <h2>Newsletter</h2>
                <p>Subscribe to our newsletter for the latest updates:</p>
                <div class="newsletter">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit">Subscribe</button>
                </div>
            </div>

            <!-- Column 4: Social Media -->
            <div class="column">
                <h2>Follow Us</h2>
                <div class="social-icons">
                    <a href="#"><i class="bx bxl-instagram"></i></a>
                    <a href="#"><i class="bx bxl-facebook-square"></i></a>
                    <a href="#"><i class="bx bxl-twitter"></i></a>
                </div>
            </div>

            <!-- Row 2:Address section -->
            <div class="column">
                <h2>Address:</h2>
                <p>1234 Ryze Street, Suite 100, City, State, 12345</p>
            </div>

            <!-- Row 2:Phone number -->
            <div class="column">
                <h2>Phone:</h2>
                <li>(123) 456-7890</li>
                <li>(123) 456-7890</li>
            </div>

            <!-- Row 2:Email section -->
            <div class="column">
                <h2>Email:</h2>
                <li>contact@ryze.com</li>
                <li>contact@ryze.com</li>
            </div>
        </div>

        <!-- Bottom Row -->
        <div class="bottom-row">
            Copyright &copy; 2024 Ryze, All Rights Reserved.
        </div>
    </footer>

    <!------------------- Links for script ---------------->
    <script type="module" src="../assets/js/header.js?v=<?= $version ?>"></script>
</body>

</html>