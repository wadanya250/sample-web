<?php
require_once 'db/connect.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Validate input
    if (empty($username) || empty($email) || empty($password)) {
        $message = 'All fields are required.';
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Insert new user into the database with role 'member'
            $stmt = $pdo->prepare('INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)');
            $stmt->execute([$username, $email, $hashedPassword, 'member']);
            
            $message = 'Registration successful. You can now <a href="login.php">login</a>.';
        } catch (PDOException $e) {
            $message = 'Registration failed: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AucaFitness Gym</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Register for AucaFitness Gym</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="login.php">Join Us</a></li>
                <li><a href="register.php">Sign Out</a></li>
            </ul>
        </nav>
    </header>

    <main style=" background-image: url(images/_DSC6427.jpg); background-position: 5%; ">
        <section class="register">
            <h2>Create Your Account</h2>
            <?php if ($message): ?>
                <div class="message">
                    <p><?php echo $message; ?></p>
                </div>
            <?php endif; ?>
            <form action="register.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Register</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 AucaFitness Gym. All Rights Reserved.</p>
    </footer>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
