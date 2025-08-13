<?php 
require 'config.php';
if (!isset($_SESSION['user'])) {
    redirect('login.php', 'Please login first');
}
$rooms = $conn->query("SELECT * FROM rooms WHERE status = 'available'")->fetchAll();
$roomTypes = [];
$roomPrices = [];
foreach ($rooms as $room) {
    $roomTypes[] = ucfirst($room['type']);
    $roomPrices[] = $room['price'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Rooms - Luxury Hotel</title>
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
</nav>
    <div class="container">
        <h1>Our Rooms</h1>
        <div class="room-prices-chart" data-aos="fade-up">
            <h2>Room Price Comparison</h2>
            <canvas id="roomPriceChart" width="400" height="200"></canvas>
        </div>
        <div class="room-list">
            <?php foreach ($rooms as $index => $room): ?>
            <div class="room-card" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                <div class="swiper room-swiper">
                    <div class="swiper-wrapper">
                        <?php 
                        $roomType = $room['type'];
                        $imagePath = '';
                        switch ($roomType) {
                            case 'standard':
                                $imagePath = 'image/eat.jpg';
                                break;
                            case 'deluxe':
                                $imagePath = 'image/deluxe.jpg';
                                break;
                            case 'suite':
                                $imagePath = 'image/suite.jpg';
                                break;
                            default:
                                $imagePath = 'https://via.placeholder.com/400x200?text=No+Image';
                        }
                        echo '<div class="swiper-slide"><img src="' . htmlspecialchars($imagePath) . '" alt="' . ucfirst($roomType) . ' Room" loading="lazy"></div>';
                        ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <h3><?= ucfirst($roomType) ?> Room</h3>
                <p>Max guests: <?= $room['max_guests'] ?></p>
                <p>Price: $<?= $room['price'] ?>/night</p>
                <a href="booking.php?room_id=<?= $room['id'] ?>" class="btn">Book Now</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        AOS.init();
        document.querySelectorAll('.room-swiper').forEach(swiper => {
            if (swiper) {
                new Swiper(swiper, {
                    loop: true,
                    pagination: { el: '.swiper-pagination', clickable: true },
                    autoplay: { delay: 3000 }
                });
            }
        });
        const ctx = document.getElementById('roomPriceChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($roomTypes) ?>,
                datasets: [{
                    label: 'Price per Night ($)',
                    data: <?= json_encode($roomPrices) ?>,
                    backgroundColor: ['#D4A017', '#1A5F7A', '#6B2D5C'],
                    borderColor: ['#B58912', '#154B60', '#5A244D'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Price ($)' } },
                    x: { title: { display: true, text: 'Room Type' } }
                },
                plugins: {
                    legend: { display: true, position: 'top' },
                    title: { display: true, text: 'Room Price Comparison' }
                }
            }
        });
    </script>
    <script src="assets/js/main.js"></script>
</body>
</html>