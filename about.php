<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Luxury Hotel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>
<body>
     <nav>
    <div class="logo">
        <h1>LUXURY HOTEL</h1>
        <p>Where Comfort Meets Elegance</p>
    </div>
    <div class="nav-links">
        <a href="index.php" class="active">Home</a>
        <a href="rooms.php">Rooms</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="bookingg.php">My Bookings</a>
        <?php endif; ?>
        <?php if (!isset($_SESSION['user'])): ?>
            <a href="login.php">Login</a>
            <a href="register.php" class="btn">Register</a>
        <?php else: ?>
            <a href="logout.php" class="btn btn-outline">Logout</a>
        <?php endif; ?>
        <a href="special-offers.php" class="btn btn-secondary">Special Offers</a>
    </div>
    <div class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <div class="container">
        <h1>About Us</h1>
        <div class="about-content" data-aos="fade-up">
            <p>Welcome to Luxury Hotel, where elegance meets comfort. Established in 2010, we have been committed to providing world-class hospitality with a focus on luxury and personalized service. Our team strives to create unforgettable experiences for every guest.</p>
            <img src="assets/images/room-types/about-image.jpg" alt="Hotel Overview" class="about-image" loading="lazy">
            <p>Located in the heart of Luxury City, our hotel features state-of-the-art amenities, including an infinity pool, fine dining restaurants, and spacious rooms designed for relaxation. Join us and discover the difference!</p>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>LUXURY HOTEL</h3>
                    <p>123 Premium Avenue<br>Luxury City, LC 12345</p>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <a href="index.php">Home</a>
                    <a href="rooms.php">Rooms</a>
                    <a href="about.php">About</a>
                    <a href="contact.php">Contact</a>
                </div>
                <div class="footer-column">
                    <h3>Contact</h3>
                    <p>reservations@luxuryhotel.com<br>+1 (555) 123-4567</p>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Luxury Hotel. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="assets/js/main.js"></script>
</body>
</html>