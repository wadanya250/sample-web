<?php
require_once 'db/connect.php';
session_start();

// Redirect if not a staff
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header('Location: login.php');
    exit();
}

// Fetch all members
$stmt = $pdo->query('SELECT u.id, u.username, u.email, m.start_date, m.end_date, m.status
                     FROM users u
                     LEFT JOIN memberships m ON u.id = m.user_id
                     WHERE u.role = "member"');
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle delete membership
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $stmt = $pdo->prepare('DELETE FROM memberships WHERE user_id = ?');
    $stmt->execute([$deleteId]);
    header('Location: staff_dashboard.php');
    exit();
}

// Handle update membership
if (isset($_POST['update_id'])) {
    $updateId = $_POST['update_id'];
    $newStatus = $_POST['status'];
    $stmt = $pdo->prepare('UPDATE memberships SET status = ? WHERE user_id = ?');
    $stmt->execute([$newStatus, $updateId]);
    header('Location: staff_dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - AucaFitness Gym</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Staff Dashboard</h1>
        <nav>
            <ul>
            
                 <li><a href="Staff_dashboard.php">Dashboard</a></li>
                <li><a href="logout.php" onclick="return confirmLogout();">Logout</a></li>
            </ul>
        </nav>
</header>

<main style=" background-image: url(images/_DSC6427.jpg);">
    <section class="dashboard">
        <h2>Member Management</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($member['username']); ?></td>
                        <td><?php echo htmlspecialchars($member['email']); ?></td>
                        <td><?php echo $member['start_date'] ? $member['start_date'] : 'N/A'; ?></td>
                        <td><?php echo $member['end_date'] ? $member['end_date'] : 'N/A'; ?></td>
                        <td><?php echo $member['status'] ? ucfirst($member['status']) : 'N/A'; ?></td>
                        <td>
                            
                            <form action="staff_dashboard.php" method="post" style="display:inline;">
                                <input type="hidden" name="update_id" value="<?php echo $member['id']; ?>">
                                <select name="status">
                                    <option value="active" <?php if ($member['status'] === 'active') echo 'selected'; ?>>Active</option>
                                    <option value="inactive" <?php if ($member['status'] === 'inactive') echo 'selected'; ?>>Inactive</option>
                                </select>
                                <button type="submit">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<footer>
    <p>&copy; 2024 AucaFitness Gym. All Rights Reserved.</p>
</footer>
<script src="js/scripts.js"></script>

</body>
</html>