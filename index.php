<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Website</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>AUCAFitness</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                <li><a href="login.php">Join Us</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="member_dashboard.php">Book</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main style=" background-image: url(images/_DSC6427.jpg); background-position: 5%; ">
        <section class="home">
            <h2>About AucaFitness Gym</h2>
            <p>AUCAFitness is a state-of-the-art gym dedicated to helping you achieve your fitness goals. With its modern equipment and a wide range of classes, it caters to every fitness level and interest. Whether you're into high-intensity training or prefer a more relaxed workout, AUCAFitness has something for you.</p>

<p>The gym's knowledgeable trainers are committed to providing personalized support and guidance. They create tailored workout plans to ensure you stay motivated and see results. Additionally, the welcoming atmosphere makes AUCAFitness more than just a gym—it's a community where fitness enthusiasts can thrive together.</p>
<a class="join" href="login.php">Join Us</a><br><br>
            <img src="images/q1.jpg" alt="Gym Image">
        </section>
    </main>

    <footer>
        <p>&copy; 2024 AucaFitness Gym. All Rights Reserved.</p>
    </footer>
</body>
</html>
