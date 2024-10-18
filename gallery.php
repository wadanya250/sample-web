<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
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
    <section id="gallery">
        <div class="container">
            <h2>Gallery</h2>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="images/w9.jpg" alt="Gym Interior">
                    
                </div>
                <div class="gallery-item">
                    <img src="images/w2.jpg" alt="Fitness Class">
                    
                </div>
                <div class="gallery-item">
                    <img src="images/w3.jpg" alt="Personal Training">
                   
                </div>
                <div class="gallery-item">
                    <img src="images/w4.jpg" alt="Cardio Equipment">
                   
                </div>
                <!-- Add more images as needed -->
                <div class="gallery-item">
                    <img src="images/w5.jpg" alt="Gym Interior">
                    
                </div>
                <div class="gallery-item">
                    <img src="images/w6.jpg" alt="Fitness Class">
                    
                </div>
                <div class="gallery-item">
                    <img src="images/w7.jpg" alt="Personal Training">
                    
                </div>
                <div class="gallery-item">
                    <img src="images/w8.jpg" alt="Cardio Equipment">
                    
                </div>
            </div>
        </div>
    </section>
</main>
   <footer>
        <p>&copy; 2024 AucaFitness Gym. All Rights Reserved.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
