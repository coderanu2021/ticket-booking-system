
<?php
session_start();
require 'config/db.php';



$stmt = $pdo->query("SELECT * FROM events");
$events = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking - Free Event Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, #f3e8ff, #dbeafe);
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .banner {
            background: url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;
            height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
            position: relative;
        }
        .banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .banner-content {
            z-index: 2;
        }
        .event-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        .event-card img {
            transition: transform 0.5s ease;
        }
        .event-card:hover img {
            transform: scale(1.1);
        }
        .book-btn {
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: block;
            text-align: center;
        }
        .book-btn:hover {
            background-color: #4f46e5;
            transform: scale(1.05);
        }
        .message {
            animation: fadeInOut 3s ease-in-out;
        }
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-10px); }
            10% { opacity: 1; transform: translateY(0); }
            90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-10px); }
        }
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #ffffff;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        footer {
            background: linear-gradient(90deg, #1f2937, #111827);
        }
    </style>
</head>
<body>
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
                     alt="<?= htmlspecialchars($event['image_path']) ?>" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-3">
                        <?= htmlspecialchars($event['name']) ?>
                    </h3>
                    <p class="text-gray-600 mb-2">
                        <strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?>
                    </p>
                    <p class="text-gray-600 mb-2">
                        <strong>Venue:</strong> <?= htmlspecialchars($event['venue']) ?>
                    </p>
                    <p class="text-gray-600 mb-4">
                        <strong>Available Seats:</strong> <span id="seats-<?= $event['id'] ?>">
                            <?= htmlspecialchars($event['available_seats']) ?>
                        </span>
                    </p>
                    <button onclick="bookTicket(<?= $event['id'] ?>)" 
                            class="book-btn bg-indigo-600 text-white w-full py-3 rounded-lg font-medium">
                        Book Ticket
                    </button>
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
                <h3 class="text-2xl font-bold mb-4">TicketVibe</h3>
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
    </body>
    </html>