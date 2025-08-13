<?php 
require 'config.php';

// Check login
if (!isset($_SESSION['user'])) {
    redirect('login.php', 'Please login first');
}

// Get room details
$room_id = $_GET['room_id'] ?? null;
if (!$room_id) redirect('rooms.php');

$room = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
$room->execute([$room_id]);
$room = $room->fetch();

if (!$room) redirect('rooms.php', 'Room not found');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Room - Luxury Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
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
            <a href="booking.php">My Bookings</a>
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
    </nav>

    <div class="container">
        <h1>Book <?= ucfirst($room['type']) ?> Room</h1>
        
        <form action="payment.php" method="POST">
            <input type="hidden" name="room_id" value="<?= $room['id'] ?>">
            
            <div class="form-group">
                <label>Check-in Date</label>
                <input type="date" name="check_in" id="check-in" required>
            </div>
            
            <div class="form-group">
                <label>Check-out Date</label>
                <input type="date" name="check_out" id="check-out" required>
            </div>
            
            <div class="form-group">
                <label>Total Price</label>
                <div id="total-price">Select dates to calculate</div>
            </div>
            
            <button type="submit" class="btn">Continue to Payment</button>
        </form>
    </div>

    <script src="booking.js"></script>
</body>
</html>