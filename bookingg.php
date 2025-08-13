<?php 
require 'config.php';

// Check login
if (!isset($_SESSION['user'])) {
    redirect('login.php', 'Please login first');
}

$user_id = is_array($_SESSION['user']) ? $_SESSION['user']['id'] : $_SESSION['user'];

// Handle booking confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'confirm_booking') {
    $room_id = $_POST['room_id'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $total_price = $_POST['total_price'];
    $guest_count = $_POST['guest_count'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, room_id, check_in_date, check_out_date, total_price, guest_count, booking_date) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$user_id, $room_id, $check_in_date, $check_out_date, $total_price, $guest_count]);

    // Chuyển hướng về trang bookingg.php sau khi lưu
    redirect('bookingg.php', 'Booking confirmed successfully!');
}

// Get user's bookings
$bookings = $conn->prepare("
    SELECT b.*, r.type as room_type, r.price 
    FROM bookings b 
    JOIN rooms r ON b.room_id = r.id 
    WHERE b.user_id = ? 
    ORDER BY b.booking_date DESC
");
$bookings->execute([$user_id]);
$bookings = $bookings->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings - Luxury Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h1>LUXURY HOTEL</h1>
            <p>Where Comfort Meets Elegance</p>
        </div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="rooms.php">Rooms</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="bookingg.php" class="active">My Bookings</a>
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
        <h1>My Bookings</h1>
        
        <?php if (isset($_SESSION['message'])): ?>
            <p style="color: green;"><?= $_SESSION['message']; unset($_SESSION['message']); ?></p>
        <?php endif; ?>

        <?php if (empty($bookings)): ?>
            <div class="no-bookings">
                <p>You haven't made any bookings yet.</p>
                <a href="rooms.php" class="btn">Browse Rooms</a>
            </div>
        <?php else: ?>
            <div class="bookings-list">
                <?php foreach ($bookings as $booking): ?>
                    <div class="booking-card">
                        <div class="booking-info">
                            <h3><?= ucfirst($booking['room_type']) ?> Room</h3>
                            <p><strong>Check-in:</strong> <?= date('d/m/Y', strtotime($booking['check_in_date'])) ?></p>
                            <p><strong>Check-out:</strong> <?= date('d/m/Y', strtotime($booking['check_out_date'])) ?></p>
                            <p><strong>Guests:</strong> <?= $booking['guest_count'] ?> person(s)</p>
                            <p><strong>Total Price:</strong> $<?= number_format($booking['total_price'], 2) ?></p>
                            <p><strong>Booking Date:</strong> <?= date('d/m/Y H:i', strtotime($booking['booking_date'])) ?></p>
                           <div class="booking-actions">
    <a href="contact.php" class="btn btn-sm btn-outline">Contact Support</a>
</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .booking-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .booking-info h3 {
            margin-bottom: 15px;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        
        .booking-info p {
            margin: 8px 0;
            font-size: 16px;
        }
        
        .booking-actions {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .btn-sm {
            padding: 8px 16px;
            font-size: 14px;
            margin-right: 10px;
        }
        
        .no-bookings {
            text-align: center;
            padding: 50px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .no-bookings p {
            font-size: 18px;
            margin-bottom: 20px;
            color: #666;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #0056b3;
        }
        
        .btn-outline {
            background: transparent;
            color: #007bff;
            border: 1px solid #007bff;
        }
        
        .btn-outline:hover {
            background: #007bff;
            color: white;
        }
    </style>
</body>
</html>