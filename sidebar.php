<!-- sidebar.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
    .sidebar {
        width: 220px;
        background-color: #1e1e2f;
        color: #fff;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        padding-top: 30px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 1.5rem;
        color: #fff;
    }

    .sidebar a {
        color: #ddd;
        text-decoration: none;
        padding: 14px 20px;
        font-size: 1rem;
        transition: background 0.3s, color 0.3s;
        display: flex;
        align-items: center;
    }

    .sidebar a i {
        margin-right: 12px;
        font-size: 1.2rem;
    }

    .sidebar a:hover {
        background-color: #2c2c40;
        color: #fff;
    }

    @media (max-width: 768px) {
        .sidebar {
            display: none;
        }
    }
</style>

<div class="sidebar">
    <h2>🎟️ Events</h2>
    <a href="events.php"><i class="fas fa-calendar-alt"></i>Available Events</a>
    <a href="history.php"><i class="fas fa-clock"></i>My Bookings</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
</div>
