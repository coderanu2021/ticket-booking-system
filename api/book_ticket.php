<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    exit(json_encode(['success' => false, 'message' => 'Login required']));
}

$event_id = (int)$_POST['event_id'];
$user_id = $_SESSION['user_id'];

// Fetch available seats from the database
$stmt = $pdo->prepare("SELECT available_seats FROM events WHERE id = ?");
$stmt->execute([$event_id]);
$event = $stmt->fetch();

if ($event && $event['available_seats'] > 0) {
    // Insert the booking record
    $pdo->prepare("INSERT INTO bookings (user_id, event_id) VALUES (?, ?)")->execute([$user_id, $event_id]);

    // Update available seats for the event
    $pdo->prepare("UPDATE events SET available_seats = available_seats - 1 WHERE id = ?")->execute([$event_id]);

    // Fetch the updated event details
    $stmt = $pdo->prepare("SELECT available_seats FROM events WHERE id = ?");
    $stmt->execute([$event_id]);
    $updated_event = $stmt->fetch();

    // Return updated seats count as a JSON response
    echo json_encode(['success' => true, 'message' => 'Booking successful!', 'available_seats' => $updated_event['available_seats']]);
} else {
    echo json_encode(['success' => false, 'message' => 'No seats available']);
}
?>
