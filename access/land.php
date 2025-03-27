<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Navigator - Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

    <?php 
        include $_SERVER['DOCUMENT_ROOT'] . '/access/nav.php';
    ?>

    <style>
       :root {
            --primary-color: #1F0E58;
            --secondary-color: #004EA9;
            --accent-color: #FFFFFF;
            --glass-bg: rgba(255, 255, 255, 0.2);
            --glass-border: rgba(255, 255, 255, 0.3);
            --blur-intensity: 15px;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--accent-color);
        }

        /* Hero Section */
        .hero-section {
            text-align: center;
            padding: 100px 20px;
        }

        .hero-section h1 {
            font-weight: bold;
        }

        /* Feature Cards - Glassmorphism Effect */
        .feature-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(var(--blur-intensity));
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        /* Feature Icons */
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: white;
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 20px;
            }

            .feature-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4">Welcome to Grossmont Maps!</h1>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="pb-5">
        <div class="container">
            <h2 class="text-center mb-5">Explore Our Features</h2>
            <div class="row g-4 justify-content-center">
                
                <div class="col-md-4">
                    <a href="/users/profile.php" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="feature-icon">🪪</div>
                            <h3>Profile</h3>
                            <p>View your information!</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="/map/map.php" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="feature-icon">🗺️</div>
                            <h3>Map</h3>
                            <p>Learn to navigate!</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="/users/schedule.php" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="feature-icon">📓</div>
                            <h3>Schedule</h3>
                            <p>View your classes!</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

