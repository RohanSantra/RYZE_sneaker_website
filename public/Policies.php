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
    <link rel="stylesheet" href="../assets/css/policies.css?v=<?= $version ?>">
    <link rel="stylesheet" href="../assets/css/footer.css?v=<?= $version ?>">

</head>

<body>
    <!-- Header Section -->
    <?php
    include("../includes/header.php");
    ?>

    <section class="policy-section">
        <!-- Sidebar -->
        <nav class="sidebar">
            <h1>Our Policies</h1>
            <ul>
                <li><a href="#shipping-policy">Shipping Policy</a></li>
                <li><a href="#return-policy">Return & Refund Policy</a></li>
                <li><a href="#privacy-policy">Privacy Policy</a></li>
                <li><a href="#terms-service">Terms of Service</a></li>
                <li><a href="#warranty-policy">Warranty Policy</a></li>
                <li><a href="#payment-policy">Payment Policy</a></li>
                <li><a href="#cancellation-policy">Cancellation Policy</a></li>
                <li><a href="#cookies-policy">Cookies Policy</a></li>
                <li><a href="#intellectual-property">Intellectual Property</a></li>
                <li><a href="#contact-information">Contact Information</a></li>
            </ul>
        </nav>
        <!-- Content Area -->
        <div class="policy-container">

            <!-- Policies Section -->
            <!-- Shipping Policy -->
            <div class="policy-item" id="shipping-policy">
                <h2>Shipping Policy</h2>
                <p>
                    At Ryze Sneakers, we are committed to delivering your orders efficiently and promptly. Our shipping
                    process is designed to ensure that your products reach you in the best condition and within the
                    shortest possible time. We currently offer domestic shipping across the country, with plans to
                    expand internationally in the near future.
                </p>
                <p>
                    <strong>Processing Time:</strong>
                    Once you place an order, our team works diligently to process it within 1-3 business days. During
                    peak periods, such as holidays or sales, processing times may increase slightly, but we make every
                    effort to minimize delays.
                </p>
                <p>
                    <strong>Delivery Timeframe:</strong>
                    Delivery timelines vary based on your location:
                    - <strong>Standard Shipping:</strong> Typically 5-7 business days.
                    - <strong>Expedited Shipping:</strong> 2-3 business days.
                </p>
                <p>
                    <strong>Shipping Costs:</strong>
                    Shipping costs depend on your chosen shipping method and order size. Orders above a specific value
                    (e.g., $100) may qualify for free standard shipping. Exact rates will be calculated at checkout.
                </p>
                <p>
                    <strong>Tracking Your Order:</strong>
                    Once your order ships, you’ll receive a tracking number via email. This number allows you to monitor
                    your package in real-time until it reaches your doorstep.
                </p>
                <p>
                    <strong>Shipping Restrictions:</strong>
                    While we aim to deliver everywhere, certain regions may have limitations due to logistical
                    constraints. Additionally, some items, such as limited-edition releases, may have specific shipping
                    terms.
                </p>
            </div>

            <!-- Return & Refund Policy -->
            <div class="policy-item" id="return-policy">
                <h2>Return & Refund Policy</h2>
                <p>
                    At Ryze Sneakers, we prioritize customer satisfaction. If you’re not completely satisfied with your
                    purchase, we offer a straightforward return and refund process.
                </p>
                <p>
                    <strong>Return Eligibility:</strong>
                    - Items must be unused, in their original packaging, and include all accessories.
                    - Returns must be initiated within 30 days of receiving the product.
                </p>
                <p>
                    <strong>Steps to Return:</strong>
                    1. Contact our support team at <strong>support@ryze.com</strong> or call our helpline.
                    2. Provide your order number and reason for the return.
                    3. Ship the item to the address provided by our team.
                </p>
                <p>
                    <strong>Refund Process:</strong>
                    Once we receive and inspect the returned item, refunds are processed within 7-10 business days.
                    Refunds are issued to the original payment method, and shipping charges (if applicable) are
                    non-refundable.
                </p>
                <p>
                    <strong>Non-Returnable Items:</strong>
                    - Gift cards
                    - Customized or personalized items
                </p>
            </div>

            <!-- Privacy Policy -->
            <div class="policy-item" id="privacy-policy">
                <h2>Privacy Policy</h2>
                <p>
                    We value your trust and are committed to protecting your personal information. Our privacy policy
                    outlines how we collect, use, and safeguard your data.
                </p>
                <p>
                    <strong>What We Collect:</strong>
                    - Personal details like name, email, and address for order fulfillment.
                    - Payment information processed through secure third-party gateways.
                    - Browsing behavior for improving user experience.
                </p>
                <p>
                    <strong>How We Use It:</strong>
                    - To process orders and deliver products.
                    - To send promotional emails (opt-in only).
                    - To analyze website traffic and enhance functionality.
                </p>
                <p>
                    <strong>Your Rights:</strong>
                    You can request access to your data, ask for corrections, or opt-out of data collection entirely.
                    For more details, refer to our full privacy policy.
                </p>
            </div>

            <!-- Terms of Service -->
            <div class="policy-item" id="terms-service">
                <h2>Terms of Service</h2>
                <p>
                    By using the Ryze Sneakers website, you agree to abide by our terms and conditions. These terms
                    ensure a fair and transparent relationship between us and our customers.
                </p>
                <p>
                    <strong>Key Terms:</strong>
                    - Customers must provide accurate information for orders.
                    - Misuse of the website, such as hacking or unauthorized access, is prohibited.
                    - Ryze Sneakers reserves the right to cancel orders suspected of fraud.
                </p>
                <p>
                    <strong>Disputes:</strong>
                    Any disputes arising from these terms will be resolved in accordance with local laws.
                </p>
            </div>

            <!-- Warranty Policy -->
            <div class="policy-item" id="warranty-policy">
                <h2>Warranty Policy</h2>
                <p>
                    Ryze Sneakers stands by the quality of our products. Our 1-year warranty covers manufacturing
                    defects, ensuring your peace of mind.
                </p>
                <p>
                    <strong>What’s Covered:</strong>
                    - Defective materials or workmanship
                    - Damage not caused by misuse or improper care
                </p>
                <p>
                    <strong>Claim Process:</strong>
                    1. Submit a warranty claim via our website or support team.
                    2. Provide proof of purchase and photos of the defect.
                </p>
                <p>
                    <strong>Exclusions:</strong>
                    Normal wear and tear or damage caused by improper use is not covered.
                </p>
            </div>

            <!-- Payment Policy -->
            <div class="policy-item" id="payment-policy">
                <h2>Payment Policy</h2>
                <p>
                    We offer a variety of secure payment options to make your shopping experience seamless.
                </p>
                <p>
                    <strong>Accepted Methods:</strong>
                    - Credit and debit cards (Visa, MasterCard, etc.)
                    - Digital wallets (PayPal, Google Pay, etc.)
                </p>
                <p>
                    <strong>Transaction Security:</strong>
                    All payments are encrypted using industry-standard SSL protocols to ensure your data remains safe.
                </p>
            </div>

            <!-- Cancellation Policy -->
            <div class="policy-item" id="cancellation-policy">
                <h2>Cancellation Policy</h2>
                <p>
                    We understand that sometimes plans change. Orders can be canceled within 24 hours of placement.
                    Beyond this timeframe, cancellations may not be possible as the order could be in processing or
                    already shipped.
                </p>
                <p>
                    <strong>Cancellation Steps:</strong>
                    1. Contact our support team promptly.
                    2. Provide your order details for quick processing.
                </p>
            </div>

            <!-- Cookies Policy -->
            <div class="policy-item" id="cookies-policy">
                <h2>Cookies Policy</h2>
                <p>
                    Our website uses cookies to enhance your browsing experience. Cookies help us provide personalized
                    content, save your preferences, and analyze website traffic.
                </p>
                <p>
                    <strong>Managing Cookies:</strong>
                    You can manage or disable cookies through your browser settings. However, disabling cookies may
                    limit certain website functionalities.
                </p>
            </div>

            <!-- Intellectual Property -->
            <div class="policy-item" id="intellectual-property">
                <h2>Intellectual Property</h2>
                <p>
                    All content on the Ryze Sneakers website, including images, text, logos, and designs, is owned by
                    us. Unauthorized use, reproduction, or distribution is strictly prohibited.
                </p>
                <p>
                    <strong>Licensing:</strong>
                    If you wish to use any of our content, please contact us for licensing agreements.
                </p>
            </div>

            <!-- Contact Information -->
            <div class="policy-item" id="contact-info">
                <h2>Contact Information</h2>
                <p>
                    For any inquiries, you can reach us at: <br>
                    - <strong>Email:</strong> support@ryze.com <br>
                    - <strong>Phone:</strong> (123) 456-7890 <br>
                    - <strong>Address:</strong> 1234 Ryze Street, Suite 100, City, State, 12345
                </p>
                <p>
                    We aim to respond to all inquiries within 24 hours.
                </p>
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
    <script type="module" src="../assets/js/FAQ.js?v=<?= $version ?>"></script>

</body>

</html>