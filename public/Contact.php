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
                <form action="../api/user/process_contact.php" method="POST" enctype="multipart/form-data">
                    <input type="text" id="name" name="name" placeholder="Name" required>
                    <input type="email" id="email" name="email" placeholder="E-mail" required>
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Phone" required>
                    <textarea id="message" name="message" placeholder="Message"></textarea>
                    <div class="upload-section">
                        <label for="upload" class="label">
                            <i class='bx bx-cloud-upload'></i> Upload file
                        </label>
                        <input type="file" id="upload" name="upload" accept="image/*,.pdf,.doc" multiple>
                    </div>
                    <button type="submit">Send Message</button>
                </form>

            </div>
        </div>
    </section>

    <!-- Footer section -->
    <?php
        include("../includes/footer.php");
    ?>

    <!------------------- Links for script ---------------->
    <script type="module" src="../assets/js/header.js?v=<?= $version ?>"></script>
</body>

</html>