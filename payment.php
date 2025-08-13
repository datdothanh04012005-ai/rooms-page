<?php 
require 'config.php';
if (!isset($_SESSION['user']) || $_SERVER['REQUEST_METHOD'] != 'POST') {
    redirect('rooms.php');
}
$room_id = $_POST['room_id'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$room = $conn->prepare("SELECT * FROM rooms WHERE id = ?"); // Lấy thêm type
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
            <h1>Luxury Hotel</h1>
        </div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="rooms.php">Rooms</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <div class="container">
        <h1>Complete Your Booking</h1>
        <div class="booking-summary" data-aos="fade-up">
            <h3>Booking Details</h3>
            <p>Room Type: <?= ucfirst($room['type']) ?></p>
            <p>Dates: <?= $check_in ?> to <?= $check_out ?></p>
            <p>Total: $<?= number_format($total, 2) ?></p>
        </div>
        <form action="confirmation.php" method="POST">
            <input type="hidden" name="room_id" value="<?= $room_id ?>">
            <input type="hidden" name="check_in" value="<?= $check_in ?>">
            <input type="hidden" name="check_out" value="<?= $check_out ?>">
            <input type="hidden" name="total" value="<?= $total ?>">
            <div class="form-group">
                <label>Card Number</label>
                <input type="text" name="card_number" placeholder="1234 5678 9012 3456" required>
                <span class="form-icon">💳</span>
            </div>
            <div class="form-group">
                <label>Expiry Date</label>
                <input type="text" name="expiry" placeholder="MM/YY" required>
                <span class="form-icon">📅</span>
            </div>
            <div class="form-group">
                <label>CVV</label>
                <input type="text" name="cvv" placeholder="123" required>
                <span class="form-icon">🔒</span>
            </div>
            <button type="submit" class="btn">Confirm Payment</button>
        </form>
    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <script>
        AOS.init();
        document.querySelector('form').addEventListener('submit', function() {
            document.querySelector('.btn').classList.add('loading');
        });
    </script>
    <script src="main.js"></script>
</body>
</html>