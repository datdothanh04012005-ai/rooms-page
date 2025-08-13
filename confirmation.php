<?php
require 'config.php';

// Sử dụng logic tương tự như trong config.php
$user_id = is_array($_SESSION['user']) ? $_SESSION['user']['id'] : $_SESSION['user'];
$room_id = $_POST['room_id'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$room = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
$room->execute([$room_id]);
$room = $room->fetch();
$total = $room['price'] * (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment - Luxury Hotel</title>
    <link rel="stylesheet" href="style.css">
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
    <div class="container">
        <h1>Confirm Your Booking</h1>
        <div class="booking-summary" data-aos="fade-up">
            <h3>Booking Details</h3>
            <p>Room Type: <?= ucfirst($room['type']) ?></p>
            <p>Dates: <?= $check_in ?> to <?= $check_out ?></p>
            <p>Total: $<?= number_format($total, 2) ?></p>
        </div>
        <button type="button" class="btn" id="confirmButton">Confirm Payment</button>
    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <form id="confirmForm" action="bookingg.php" method="POST" style="display: none;">
        <input type="hidden" name="room_id" value="<?= $room_id ?>">
        <input type="hidden" name="check_in_date" value="<?= $check_in ?>">
        <input type="hidden" name="check_out_date" value="<?= $check_out ?>">
        <input type="hidden" name="total_price" value="<?= $total ?>">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
        <input type="hidden" name="guest_count" value="1">
        <input type="hidden" name="action" value="confirm_booking">
    </form>
    <script>
        AOS.init();
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('confirmButton');
            if (button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Button clicked');
                    const form = document.getElementById('confirmForm');
                    if (form) {
                        console.log('Form found');
                        button.classList.add('loading');
                        fetch('bookingg.php', {
                            method: 'POST',
                            body: new FormData(form)
                        })
                        .then(response => {
                            console.log('Response status:', response.status);
                            if (response.ok) {
                                window.location.href = 'bookingg.php';
                            } else {
                                console.error('Failed to confirm booking:', response.status);
                            }
                        })
                        .catch(error => console.error('Fetch error:', error));
                    } else {
                        console.error('Form not found');
                    }
                });
            } else {
                console.error('Button not found');
            }
        });
    </script>
    <!-- Tạm thời bỏ để loại trừ xung đột -->
    <!-- <script src="main.js"></script> -->
</body>
</html>