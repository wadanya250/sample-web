<?php
require_once 'db/connect.php';
session_start();

// Redirect if not a member
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];

// Handle membership registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = date('Y-m-d');
    $endDate = date('Y-m-d', strtotime('+1 year'));

    // Check if membership already exists
    $stmt = $pdo->prepare('SELECT * FROM memberships WHERE user_id = ?');
    $stmt->execute([$userId]);
    $membership = $stmt->fetch();

    if (!$membership) {
        $stmt = $pdo->prepare('INSERT INTO memberships (user_id, start_date, end_date, status) VALUES (?, ?, ?, ?)');
        $stmt->execute([$userId, $startDate, $endDate, 'active']);
        $message = 'Membership registered successfully!';
    } else {
        $message = 'You already have an active membership.';
    }
}

// Fetch membership information
$stmt = $pdo->prepare('SELECT * FROM memberships WHERE user_id = ?');
$stmt->execute([$userId]);
$membership = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard - AucaFitness Gym</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Member Dashboard</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="member_dashboard.php">Book</a></li>
                <li><a href="logout.php" onclick="return confirmLogout();">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main style=" background-image: url(images/_DSC6427.jpg);">
        <section class="dashboard">
            <h2>Welcome to Your Dashboard</h2>
            <?php if (isset($message)): ?>
                <div class="message">
                    <p><?php echo $message; ?></p>
                </div>
            <?php endif; ?>
            <form action="member_dashboard.php" method="post">
                <h3>Register for Membership</h3>
                <button type="submit">Register</button>
            </form>

            <?php if ($membership): ?>
                <div class="membership-info">
                    <h3>Your Membership Details</h3>
                    <p>Start Date: <?php echo $membership['start_date']; ?></p>
                    <p>End Date: <?php echo $membership['end_date']; ?></p>
                    <p>Status: <?php echo ucfirst($membership['status']); ?></p>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 AucaFitness Gym. All Rights Reserved.</p>
    </footer>
    <script src="js/scripts.js"></script>

</body>
</html>
