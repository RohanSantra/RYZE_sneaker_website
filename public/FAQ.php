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
    <link rel="stylesheet" href="../assets/css/FAQ.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/footer.css?v=<?= $version ?>">
</head>

<body>
    <!-- Header Section -->
    <?php
    include("../includes/header.php");
    ?>


    <!-- FAQ Section -->
    <section class="faq-section">
        <h1>Frequently Asked Questions</h1>
        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    <span>What makes Ryze Sneakers different from other brands?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Ryze Sneakers blend style, performance, and sustainability. Our designs are crafted with premium
                        materials and innovative features, providing unmatched comfort and durability.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>How can I place an order on the Ryze website?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>You can place an order by selecting your desired product, adding it to the cart, and proceeding
                        to checkout. Simply follow the steps and enter your payment information.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Do you offer international shipping?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>No, we do not offer international shipping, but sooner we will ship internationally.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>What is your return policy?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>We offer a money-back guarantee for returns within 5 days of receiving your order.</p>
                </div>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>How long does it take to process an order?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Orders are typically processed within 1-3 business days. Delivery times vary depending on your
                    location.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Can I cancel my order?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Orders can be canceled within 24 hours of placement. Please contact our customer support as soon as
                    possible to cancel an order.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Do you offer warranty or product guarantees?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Yes, we offer a warranty covering manufacturing defects for 1 year from the date of purchase.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>How do I track my order?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>You will receive a tracking link via email once your order has shipped. You can track your order
                    using this link.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>What payment methods do you accept?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>We accept credit/debit cards (Visa, MasterCard, AmEx) and online payments options like paypal, paytm,
                    phonepay, google pay and apple pay. We also accept cash on delivery option.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Do you have a loyalty program?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Yes, we have a rewards program where you can earn points with every purchase that can be redeemed for
                    discounts and exclusive offers.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>How can I contact customer support?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>You can contact our customer support via email at contact@ryze.com or through our support form
                    available on the Contact page.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Are Ryze Sneakers eco-friendly?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Yes, we are committed to sustainability by using eco-friendly materials and reducing our carbon
                    footprint wherever possible.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>What sizes do Ryze Sneakers offer?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>We offer a wide range of sizes from US 1 to US 12. </p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Can I customize my order?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Currently, we offer limited customization options. Stay tuned for future updates as we work on
                    providing more customization features.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Do you have a physical store?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>You can unsubscribe from our newsletter by clicking the "unsubscribe" link at the bottom of any
                    newsletter email.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>How can I unsubscribe from your newsletter?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>You can unsubscribe from our newsletter by clicking the "unsubscribe" link at the bottom of any
                    newsletter email.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Do you offer gift cards?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>No, we do not offer digital gift cards that can be used as payment on our website.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Are the sneakers true to size?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Yes, our sneakers typically fit true to size. However, we recommend referring to our size guide for
                    any sizing concerns.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>How do I track product releases and new collections?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>You can stay updated by subscribing to our newsletter and following us on social media.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Do you offer exchanges?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>We currently only offer returns for refunds, but exchanges may be available on a case-by-case basis.
                    Contact customer support for further assistance.</p>
            </div>
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
    <script type="module" src="../assets/js/FAQ.js"></script>
</body>

</html>