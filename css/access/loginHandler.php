<?php session_start();
// Include your database connection file
require_once('../database/dbConnection.php');

// Get the submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];

// Query the database to check the credentials
$stmt = $pdo->prepare("SELECT * FROM Users WHERE uName = :username AND pWord = :password");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If the user is found, start a session and redirect to the landing page
if ($user) {
    
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['uName'];
    header("Location: /access/land.php");
    exit;
} else {
    // Redirect back to the login page with an error message
    header("Location: /access/login.php?error=Invalid%20credentials");
    exit;
}
?>