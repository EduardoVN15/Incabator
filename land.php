<?php
if (isset($_GET['user'])) {
    $user = htmlspecialchars($_GET['user']);
} else {
    $user = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Navigator - Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php include 'access/navbar.php'; ?>
    <!-- Welcome Section -->
    <section class="py-5">
        <div class="container text-center">
            <h2>Welcome to Campus Navigator</h2>
            <p>Navigate through your school campus easily with our platform. Log in to access your personalized schedule, class locations, and more!</p>
            <a href="/access/login.php" class="btn btn-primary">Log In</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container text-center">
            <h3>Features</h3>
            <ul class="list-unstyled">
                <li><strong>Real-time Navigation:</strong> Get directions to your classrooms.</li>
                <li><strong>Schedule Integration:</strong> Sync your schedule with our platform.</li>
                <li><strong>Emergency Routes:</strong> Find the quickest escape routes in case of emergencies.</li>
            </ul>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-5">
        <div class="container text-center">
            <h3>How It Works</h3>
            <p>Simply log in with your school credentials, and our platform will guide you to your destination with ease. The intuitive layout and real-time GPS updates make campus navigation a breeze.</p>
        </div>
    </section>

    <!-- Get Started Section -->
    <section id="get-started" class="py-5 bg-light">
        <div class="container text-center">
            <h3>Get Started</h3>
            <p>Ready to navigate your campus like a pro? Log in now to begin.</p>
            <a href="/access/login.php" class="btn btn-primary">Log In</a>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
