<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - AucaFitness Gym</title>
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
        <section class="about">
            <h2>Our Story</h2>
            <p>AUCAFitness, nestled within the vibrant AUCA University campus, has always been more than just a gym; it's a hub of energy and motivation. When the university first envisioned AUCAFitness, they aimed to create a space where students could blend their academic pursuits with their personal fitness goals. The gym quickly became the heartbeat of the campus, where students, faculty, and staff converged not only to work out but to build connections and share their journeys toward better health.</p>

<p>One memorable story from AUCAFitness involves a group of students who started an early morning workout tradition. Despite their busy schedules, they found a shared passion for fitness and began meeting daily for sunrise yoga sessions. This routine not only improved their physical health but also forged deep friendships and a strong sense of community. As the word spread, more students joined, and the once-quiet gym became a lively place where everyone felt like part of a supportive family, proving that AUCAFitness was indeed a cornerstone of campus life.</p>

            <h3>Our Team</h3>
            <p>Meet our experienced staff who are here to guide you on your fitness journey.</p>
            <ul>
                <li>Christophe - Head Trainer</li>
                <li>Chris - Nutritionist</li>
                <li>Libenz - Fitness Coach</li>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 AucaFitness Gym. All Rights Reserved.</p>
    </footer>
</body>
</html>
