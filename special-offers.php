<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special Offers - Luxury Hotel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
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
</nav> </nav>
    <div class="container">
        <h1>Special Offers</h1>
        <div class="offers-slider" data-aos="fade-up">
            <div class="swiper offers-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="offer-card">
                            <img src="assets/images/special-offers/offer-1.jpg" alt="Weekend Getaway Offer" loading="lazy">
                            <h3>Weekend Getaway</h3>
                            <p>Enjoy 20% off on weekend stays. Valid until 31/08/2025.</p>
                            <a href="booking.php?offer=weekend" class="btn btn-accent">Book Now</a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="offer-card">
                            <img src="assets/images/special-offers/offer-2.jpg" alt="Family Package Offer" loading="lazy">
                            <h3>Family Package</h3>
                            <p>Stay 4 nights, get 1 night free. Includes kids' activities.</p>
                            <a href="booking.php?offer=family" class="btn btn-accent">Book Now</a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="offer-card">
                            <img src="assets/images/special-offers/offer-3.jpg" alt="Honeymoon Special" loading="lazy">
                            <h3>Honeymoon Special</h3>
                            <p>Complimentary spa and dinner for newlyweds. Book by 15/09/2025.</p>
                            <a href="booking.php?offer=honeymoon" class="btn btn-accent">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
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
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        new Swiper('.offers-swiper', {
            loop: true,
            autoplay: { delay: 5000 },
            pagination: { el: '.swiper-pagination', clickable: true }
        });
    </script>
    <script src="main.js"></script>
</body>
</html>