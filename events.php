<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM events");
$events = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Events</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include 'head.php'; ?>

</head>
<body>
    <!-- Include the Header -->
    <?php include 'header.php'; ?>

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main content -->
    <div class="main-content">
        <header>
            <h2>Available Events</h2>
        </header>

        <div class="event-list">
            <?php foreach ($events as $event): ?>
                <div class="event-item" id="event-<?= $event['id'] ?>">
                    <h4><?= htmlspecialchars($event['name']) ?></h4>
                    <p><strong>Date:</strong> <?= $event['event_date'] ?><br>
                       <strong>Venue:</strong> <?= $event['venue'] ?><br>
                       <strong>Seats:</strong> <span id="seats-<?= $event['id'] ?>"><?= $event['available_seats'] ?></span>
                    </p>
                    <button class="book-btn" onclick="bookTicket(<?= $event['id'] ?>)">Book Ticket</button>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="response" class="response" style="display:none;"></div>    </div>

    <script src="assets/script.js"></script>

   
</body>
</html>