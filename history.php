<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Pagination settings
$limit = 8;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Count total bookings
$count_stmt = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE user_id = ?");
$count_stmt->execute([$_SESSION['user_id']]);
$total_records = $count_stmt->fetchColumn();
$total_pages = ceil($total_records / $limit);

// Fetch bookings
$stmt = $pdo->prepare("SELECT e.name, e.event_date, e.venue, b.booked_at 
                       FROM bookings b 
                       JOIN events e ON b.event_id = e.id 
                       WHERE b.user_id = ? 
                       ORDER BY b.booked_at DESC 
                       LIMIT ? OFFSET ?");
$stmt->bindValue(1, $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->bindValue(2, $limit, PDO::PARAM_INT);
$stmt->bindValue(3, $offset, PDO::PARAM_INT);
$stmt->execute();
$bookings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php include 'head.php'; ?></head>
<body>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="main-content">
    <h2 class="mb-4">My Bookings</h2>

    <?php if (count($bookings) === 0): ?>
        <div class="alert alert-info text-center">No bookings found.</div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($bookings as $b): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($b['name']) ?></h5>
                            <p class="card-text">
                                <strong>Date:</strong> <?= htmlspecialchars($b['event_date']) ?><br>
                                <strong>Venue:</strong> <?= htmlspecialchars($b['venue']) ?><br>
                                <strong>Booked At:</strong> <?= date('d M Y, h:i A', strtotime($b['booked_at'])) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Debug Info (optional) -->
    <div class="text-center text-muted mt-4">
        <small>Total Records: <?= $total_records ?> | Page: <?= $page ?> / <?= $total_pages ?></small>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
