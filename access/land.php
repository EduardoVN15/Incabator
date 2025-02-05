<?php session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
//    header("Location: login.php");
//    exit;
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
	<?php 
		session_start();
		include $_SERVER['DOCUMENT_ROOT'] . '/access/nav.php';
	?>

  <style>
        :root {
            --primary-color: #6a0dad;
            --secondary-color: #ff4500;
            --accent-color: #1e88e5;
            --gradient-start: #6a0dad;
            --gradient-end: #ff4500;
        }

        body {
            font-family: 'Arial', sans-serif;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.1);
            transform: skewY(-6deg);
            transform-origin: top left;
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--accent-color);
            transition: transform 0.3s ease;
        }

        .feature-icon:hover {
            transform: scale(1.1);
        }

        .feature-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .testimonial-card {
            background-color: #f4f4f4;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            border-left: 5px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateX(10px);
        }

        #contact {
            background-color: #f9f9f9;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-3px);
        }

        .navbar {
            background-color: rgba(255,255,255,0.95) !important;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
  
    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container position-relative">
            <h1 class="display-4 mb-4 text-white">Welcome to Grossmont Maps</h1>
       
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Key Features</h2>
            <div class="row">
                
				<div class="col-md-4 mb-4">
                <a href="/access/registration.php" class="text-decoration-none">
                    <div class="feature-card h-100 text-center">
                        <div class="feature-icon">🔒</div>
                        <h3>Registration</h3>
                        <p>Begin Your Journey</p>
                    </div>
                </a>
            </div>
				
				<div class="col-md-4 mb-4">
					<a href="/access/login.php" class="text-decoration-none">
                    <div class="feature-card h-100 text-center">
                        <div class="feature-icon">🔒</div>
                        <h3>Login</h3>
                        <p>Access the land</p>
                    </div>
					</a>
                </div>
				
				 <div class="col-md-4 mb-4">
					 <a href="/users/profile.php" class="text-decoration-none">
                    <div class="feature-card h-100 text-center">
                        <div class="feature-icon">📊</div>
                        <h3>Profile</h3>
                        <p>input your schedule</p>
                    </div>
					 </a>
                </div>
				
				<div class="col-md-4 mb-4">
					 <a href="/map/map.php" class="text-decoration-none">
                    <div class="feature-card h-100 text-center">
                        <div class="feature-icon">🚀</div>
                        <h3>Map</h3>
                        <p>learn to navigate</p>
                    </div>
					</a>
				</div>
            </div>
        </div>
    </section>

   
   
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p class="mb-0">&copy; GHS Maps</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>