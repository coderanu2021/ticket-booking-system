# Simple Ticket Booking System

This project is a simple ticket booking system. It allows users to register, log in, browse events, book tickets using AJAX, and view their booking history. The system is built using Core PHP, MySQL, HTML, CSS, and Vanilla JavaScript, with security measures like prepared statements, input sanitization, and session-based authentication.

## Demo Link 
 
[![Watch the video](https://img.youtube.com/vi/vpxTNz8dlUA/0.jpg)](https://youtu.be/vpxTNz8dlUA)

## Features

1. **User Authentication**
   - User registration and login using PHP sessions.
   - Secure password storage with password hashing.
   - Non-logged-in users are redirected to the login page.

2. **Event Listing**
   - Displays 3-5 pre-defined events fetched from the MySQL database.
   - Each event includes name, date, venue, and available seats.
   - Users can click "Book Ticket" to book an event.

3. **Ticket Booking**
   - Booking is processed via AJAX to prevent page reload.
   - Updates available seats and stores booking details (user ID, event ID, timestamp) in the database.
   - Displays a success message upon booking.

4. **Booking History**
   - Users can view their past bookings with event details and booking time.
   - Pagination is implemented for handling multiple bookings.

5. **Security**
   - Uses PDO with prepared statements to prevent SQL injection.
   - Input sanitization and validation to prevent XSS.
   - Session-based authentication for secure access.

## Technology Stack

- **Backend**: Core PHP
- **Frontend**: HTML, CSS, Vanilla JavaScript (AJAX for booking)
- **Database**: MySQL

## Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache or Nginx web server
- Composer (optional, if dependencies are added)
- Git

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/ticket-booking-system.git
   cd ticket-booking-system
   ```

2. **Set Up the Database**
   - Create a MySQL database (e.g., `ticket_db`).
   - Import the `database.sql` file located in the `database/` folder to set up the schema and sample data.
   ```bash
   mysql -u your_username -p ticket_booking < database/database.sql
   ```

3. **Configure Database Connection**
   - Open `config/db.php` and update the database credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'your_username');
     define('DB_PASS', 'your_password');
     define('DB_NAME', 'ticket_db');
     ```

4. **Set Up the Web Server**
   - Place the project folder in your web server's root directory (e.g., `htdocs` for Apache).
   - Ensure the web server has write permissions for session handling.

5. **Access the Application**
   - Open your browser and navigate to `http://localhost/ticket-booking-system`.
   - Register a new user or log in to explore the system.

## Project Structure

```
ticket-booking-system/
├── config/
│   └── db.php              # Database configuration
├── database/
│   └── database.sql        # Database schema and sample data
├── assets/
│   └── styles.css          # CSS styles
│   └── scripts.js          # JavaScript for AJAX booking
│   └── images              # images for events
├── includes/
│   ├── header.php          # Common header
│   └── footer.php          # Common footer
├── pages/
│   ├── login.php           # Login page
│   ├── register.php        # Registration page
│   ├── events.php          # Event listing page
│   ├── booking.php         # Booking history page
│   └── logout.php          # Logout script
├── api/
│   └── book_ticket.php     # AJAX endpoint for ticket booking
├── index.php               # Homepage
└── README.md               # This file
```

## Usage

1. **Register/Login**: Create an account or log in to access the system.
2. **Browse Events**: View available events on the events page.
3. **Book Tickets**: Click "Book Ticket" to reserve a seat (processed via AJAX).
4. **View History**: Check your booking history with paginated results.
5. **Logout**: End your session securely.

## Notes

- Ensure the database is properly set up before running the application.
- The AJAX booking feature requires JavaScript to be enabled in the browser.
- Pagination on the booking history page is set to display 5 bookings per page (configurable in the code).
- Sample events are included in the `database.sql` file for testing.

## Contributing

This is an interview assignment project and not open for contributions. However, feel free to fork the repository and adapt it for your own use.

## License

This project is unlicensed and intended for evaluation purposes only.

## Project Status

This project has been completed and is no longer actively maintained.
