<?php
require_once 'db/connect.php';

// Initialize variables
$email = $password = '';
$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (empty($email) || empty($password)) {
        $errors[] = 'Both fields are required.';
    } else {
        // Check if user exists and password is correct
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'member') {
                header('Location: member_dashboard.php');
            } else {
                header('Location: staff_dashboard.php');
            }
            exit();
        } else {
            $errors[] = 'Invalid email or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AucaFitness Gym</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Login</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="login.php">Join Us</a></li>
            </ul>
        </nav>
    </header>

    <main style=" background-image: url(images/_DSC6427.jpg); background-position: 5%; ">
        <section class="login">
            <h2>Login to Your Account</h2>
            <?php if (!empty($errors)): ?>
                <div class="error">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="login.php?login_success=true" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
                <label>or <a href="register.php" style="text-decoration-line: none; color:  #007bff;">create an acount</a> </label>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 AucaFitness Gym. All Rights Reserved.</p>
    </footer>
</body>
</html>
