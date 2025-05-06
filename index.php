<?php
session_start();
require 'config/db.php';

$stmt = $pdo->query("SELECT * FROM events");
$events = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ticket Booking - Free Event Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/style.css" />
</head>
<body>
  <div class="ticket-booking">

    <header class="bg-gradient-to-r from-indigo-800 to-purple-900 text-white py-4 shadow-xl sticky top-0 z-50">
      <div class="container mx-auto px-4 flex justify-between items-center">
        <h1 class="text-3xl font-bold tracking-tight">TicketBooking</h1>
        <nav class="flex space-x-6">
          <a href="index.php" class="nav-link text-lg font-medium hover:text-purple-200 transition-colors">Home</a>
          <a href="login.php" class="nav-link text-lg font-medium hover:text-purple-200 transition-colors">Login</a>
          <a href="register.php" class="nav-link text-lg font-medium hover:text-purple-200 transition-colors">Register</a>
        </nav>
      </div>
    </header>

    <div class="banner">
      <div class="banner-content">
        <h2 class="text-5xl font-bold mb-4 tracking-wide">Free Events, Endless Fun</h2>
        <p class="text-xl mb-6">Reserve your spot at exciting events for free with TicketVibe!</p>
        <a href="#events" class="bg-purple-600 text-white px-8 py-3 rounded-full font-medium hover:bg-purple-700 transition-colors">Discover Events</a>
      </div>
    </div>

    <section id="features" class="container mx-auto px-4 py-16">
      <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Why TicketVibe?</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="feature-card bg-white rounded-xl shadow-lg p-6 text-center">
          <div class="text-indigo-600 text-4xl mb-4">🎟️</div>
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Free Booking</h3>
          <p class="text-gray-600">Reserve tickets for events at no cost with our user-friendly platform.</p>
        </div>
        <div class="feature-card bg-white rounded-xl shadow-lg p-6 text-center">
          <div class="text-indigo-600 text-4xl mb-4">🔔</div>
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Instant Updates</h3>
          <p class="text-gray-600">Stay informed with real-time notifications on your bookings.</p>
        </div>
        <div class="feature-card bg-white rounded-xl shadow-lg p-6 text-center">
          <div class="text-indigo-600 text-4xl mb-4">📱</div>
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Mobile Friendly</h3>
          <p class="text-gray-600">Book and manage your events on the go with our responsive design.</p>
        </div>
      </div>
    </section>

    <section id="events" class="container mx-auto px-4 py-16 bg-gray-50">
      <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Events</h2>
      <div id="message" class="message text-center text-green-600 font-medium text-lg mb-6 hidden"></div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($events as $event): ?>
          <div class="event-card bg-white rounded-xl shadow-lg overflow-hidden" id="event-<?= $event['id'] ?>">
            <img src="<?= htmlspecialchars($event['image_path'] ?? 'https://via.placeholder.com/600x400') ?>"
                 alt="<?= htmlspecialchars($event['name']) ?>"
                 class="w-full h-48 object-cover">
            <div class="p-6">
              <h3 class="text-2xl font-semibold text-gray-800 mb-3"><?= htmlspecialchars($event['name']) ?></h3>
              <p class="text-gray-600 mb-2"><strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?></p>
              <p class="text-gray-600 mb-2"><strong>Venue:</strong> <?= htmlspecialchars($event['venue']) ?></p>
              <p class="text-gray-600 mb-4"><strong>Available Seats:</strong> <span id="seats-<?= $event['id'] ?>"><?= htmlspecialchars($event['available_seats']) ?></span></p>
              <a href="login.php" class="book-btn bg-indigo-600 text-white w-full py-3 rounded-lg font-medium">Book Ticket</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section id="testimonials" class="container mx-auto px-4 py-16">
      <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">What Our Users Say</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
          <p class="text-gray-600 italic mb-4">"Booking free events with TicketBooking is so easy! The platform is super intuitive."</p>
          <p class="text-gray-800 font-semibold">Sarah M.</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
          <p class="text-gray-600 italic mb-4">"I love that I can reserve spots for events without any cost. Amazing service!"</p>
          <p class="text-gray-800 font-semibold">James T.</p>
        </div>
      </div>
    </section>

    <section id="cta" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-16 text-center">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-4">Join the Free Event Revolution!</h2>
        <p class="text-lg mb-6">Sign up now and reserve your spot at amazing events for free!</p>
        <a href="register.php" class="bg-white text-indigo-600 px-8 py-3 rounded-full font-medium hover:bg-gray-100 transition-colors">Get Started</a>
      </div>
    </section>

    <section id="faq" class="container mx-auto px-4 py-16">
      <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Frequently Asked Questions</h2>
      <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Is TicketBooking really free?</h3>
          <p class="text-gray-600">Yes! TicketBooking allows you to reserve tickets for events at no cost. Just sign up and start booking!</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
          <h3 class="text-xl font-semibold text-gray-800 mb-2">How do I view my bookings?</h3>
          <p class="text-gray-600">After logging in, navigate to the "Booking History" page to see all your reserved events.</p>
        </div>
      </div>
    </section>

    <footer class="bg-gray-800 text-white py-12">
      <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
          <h3 class="text-2xl font-bold mb-4">TicketBooking</h3>
          <p class="text-gray-400">Your gateway to free, unforgettable experiences.</p>
        </div>
        <div>
          <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
          <ul class="space-y-2">
            <li><a href="index.php" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
            <li><a href="login.php" class="text-gray-400 hover:text-white transition-colors">Events</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
          <p class="text-gray-400">Email: support@test.com</p>
          <p class="text-gray-400">Phone: 13456789</p>
        </div>
      </div>
      <div class="container mx-auto px-4 text-center mt-8">
        <p class="text-gray-400">© 2025 TicketBooking. All rights reserved.</p>
      </div>
    </footer>

  </div>
</body>
</html>
