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
    <link rel="stylesheet" href="../assets/css/About.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/footer.css?v=<?= $version ?>">
</head>

<body>
    <!-- Header Section -->
    <?php
    include("../includes/header.php");
    ?>

    <!-- Main Tagline section -->
    <section class="hero">
        <div class="hero-tagline">
            <span>Step Up Your ,</span>
            <span>Game –</span>
            <span>RYZE</span>
            <span>Above the Rest</span>
        </div>
    </section>

    <!-- About section -->
    <section class="about">
        <div class="about-container ">
            <div class="about-img autoshow">
                <img src="../assets/images/About section images/about.jpg" alt="about-part-image">
            </div>
            <div class="about-text autoshow">
                <h1>About us</h1>
                <p>
                    At <strong>Ryze Sneakers</strong>, we believe that every step tells a story. Founded with a passion
                    for
                    style and performance, we are dedicated to crafting sneakers that seamlessly blend cutting-edge
                    design
                    with everyday comfort. Whether you're hitting the streets, the gym, or a night out, our footwear is
                    designed to keep you moving in style.
                </p>
            </div>
        </div>
    </section>

    <!-- About Mission section -->
    <section class="about-mission">
        <div class="about-container">
            <div class="about-text autoshow">
                <h1>Our mission</h1>
                <p>
                    Our mission is to empower individuals to rise above the ordinary, embracing boldness and
                    self-expression through footwear that inspires confidence. We aim to create more than just shoes; we
                    create a movement that represents resilience, innovation, and a fearless attitude.
                </p>
            </div>
            <div class="about-img autoshow">
                <img src="../assets/images/About section images/mission.jpg" alt="mission-part-image">
            </div>
        </div>
    </section>

    <!-- Why section -->
    <section class="why-section">
        <h1>Why us?</h1>
        <div class="why-container autoshow">
            <div class="why-sub-container">
                <div class="why-text">
                    <h3>Unmatched Quality</h3>
                    <span>Every pair of Ryze sneakers is meticulously crafted using premium materials to ensure
                        durability and comfort.</span>
                </div>
                <div class="why-img">
                    <img src="../assets/images/About section images/quality.jpg" alt="sneaker-quality-image">
                </div>
            </div>
            <div class="why-sub-container">
                <div class="why-text">
                    <h3>Innovative Design</h3>
                    <span> Our team of designers combines fashion-forward aesthetics with ergonomic engineering,
                        delivering sneakers that stand out in performance and style.</span>
                </div>
                <div class="why-img">
                    <img src="../assets/images/About section images/design.jpg" alt="sneaker-design-image">
                </div>
            </div>
            <div class="why-sub-container">
                <div class="why-text">
                    <h3>Sustainability Focus</h3>
                    <span>We are committed to a greener planet. Our eco-friendly initiatives include sustainable
                        sourcing and reducing our carbon footprint.</span>
                </div>
                <div class="why-img">
                    <img src="../assets/images/About section images/sustainable.jpg" alt="sneaker-sustainable-image">
                </div>
            </div>
            <div class="why-sub-container">
                <div class="why-text">
                    <h3>Inclusive Range</h3>
                    <span>From streetwear enthusiasts to athletes, we offer diverse styles and sizes to suit every need
                        and personality.</span>
                </div>
                <div class="why-img">
                    <img src="../assets/images/About section images/range.jpg" alt="sneaker-range-image">
                </div>
            </div>
        </div>
    </section>

    <!-- policy section -->
    <section class="policy-section">
        <h1>Services</h1>
        <div class="policy-section-container autoshow">
            <div class="shipping">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#e8eaed">
                    <path
                        d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z" />
                </svg>
                <div class="shipping-info">
                    <span class="info-1">FREE SHIPPING</span>
                    <span class="info-2">Free shipping on all orders</span>
                </div>
            </div>
            <div class="support">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#e8eaed">
                    <path
                        d="M440-120v-80h320v-284q0-117-81.5-198.5T480-764q-117 0-198.5 81.5T200-484v244h-40q-33 0-56.5-23.5T80-320v-80q0-21 10.5-39.5T120-469l3-53q8-68 39.5-126t79-101q47.5-43 109-67T480-840q68 0 129 24t109 66.5Q766-707 797-649t40 126l3 52q19 9 29.5 27t10.5 38v92q0 20-10.5 38T840-249v49q0 33-23.5 56.5T760-120H440Zm-80-280q-17 0-28.5-11.5T320-440q0-17 11.5-28.5T360-480q17 0 28.5 11.5T400-440q0 17-11.5 28.5T360-400Zm240 0q-17 0-28.5-11.5T560-440q0-17 11.5-28.5T600-480q17 0 28.5 11.5T640-440q0 17-11.5 28.5T600-400Zm-359-62q-7-106 64-182t177-76q89 0 156.5 56.5T720-519q-91-1-167.5-49T435-698q-16 80-67.5 142.5T241-462Z" />
                </svg>
                <div class="support-info">
                    <span class="info-1">ONLINE SUPPORT</span>
                    <span class="info-2">Online support 24 hours a day</span>
                </div>
            </div>
            <div class="return">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#e8eaed">
                    <path
                        d="M480-40q-112 0-206-51T120-227v107H40v-240h240v80h-99q48 72 126.5 116T480-120q75 0 140.5-28.5t114-77q48.5-48.5 77-114T840-480h80q0 91-34.5 171T791-169q-60 60-140 94.5T480-40Zm-36-160v-52q-47-11-76.5-40.5T324-370l66-26q12 41 37.5 61.5T486-314q33 0 56.5-15.5T566-378q0-29-24.5-47T454-466q-59-21-86.5-50T340-592q0-41 28.5-74.5T446-710v-50h70v50q36 3 65.5 29t40.5 61l-64 26q-8-23-26-38.5T482-648q-35 0-53.5 15T410-592q0 26 23 41t83 35q72 26 96 61t24 77q0 29-10 51t-26.5 37.5Q583-274 561-264.5T514-250v50h-70ZM40-480q0-91 34.5-171T169-791q60-60 140-94.5T480-920q112 0 206 51t154 136v-107h80v240H680v-80h99q-48-72-126.5-116T480-840q-75 0-140.5 28.5t-114 77q-48.5 48.5-77 114T120-480H40Z" />
                </svg>
                <div class="return-info">
                    <span class="info-1">MONEY RETURN</span>
                    <span class="info-2">Back guarantee under 5 days</span>
                </div>
            </div>
        </div>
    </section>

    <!-- journey section -->
    <section class="journey-section">
        <div class="journey-container autoshow">
            <div class="journey-text">
                <h1>Our Journey</h1>
            </div>
            <p> Ryze Sneakers began as a spark of inspiration—a vision to redefine the culture of footwear and create
                something extraordinary. What started as a humble idea has grown into a global phenomenon, celebrated by
                a passionate community of sneaker enthusiasts. Along the way, our journey has been guided by a
                relentless pursuit of creativity and innovation, blending cutting-edge designs with the authenticity
                that resonates with our customers. Every step of our growth has been supported by the loyalty and trust
                of our community, who inspire us to keep pushing boundaries and setting new standards. </p>
        </div>
    </section>

    <!-- Future plans -->
    <section class="journey-section future-plan-section">
        <div class="journey-container autoshow">
            <div class="journey-text">
                <h1>Future plans</h1>
            </div>
            <p> RWe’re revolutionizing your sneaker experience with personalized AI recommendations, virtual try-ons,
                and custom design tools.
                Stay connected for exclusive collaborations, eco-friendly initiatives, and a rewards program for our
                loyal community.
                Plus, a Ryze mobile app is on the way, bringing style, innovation, and convenience to your fingertips.
            </p>
        </div>
    </section>


    <!-- Ryze Movement section -->
    <section class="last">
        <div class="last-container autoshow">
            <div class="image">
                <img src="../assets/images/About section images/movement-image-1.jpg" alt="movement-image-1">
                <img src="../assets/images/About section images/movement-image-2.jpg" alt="movement-image-2">
            </div>
            <div class="text">
                <h1>Join the Ryze Movement</h1>
                <p>Ryze Sneakers isn't just a brand; it's a lifestyle. It's about rising above challenges, standing tall
                    in your individuality, and stepping forward with purpose. Join us on our mission to redefine how
                    sneakers shape the way we live, play, and move.</p>
                <p>Follow us on our journey—stay connected for the latest releases, collaborations, and stories from our
                    community.</p>
                <div class="icons">
                    <a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a>
                    <a href="https://www.facebook.com/"><i class="bx bxl-facebook-square"></i></a>
                    <a href="https://x.com/?lang=en"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer section -->
    <?php
        include("../includes/footer.php");
    ?>

    <!------------------- Links for script ---------------->
    <script type="module" src="../assets/js/About.js?v=<?= $version ?>"></script>
</body>

</html>