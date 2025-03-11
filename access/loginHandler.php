<?php 
session_start();
// Include your database connection file
require_once('../database/dbConnection.php');

// Get the submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];

// Query the database to check the credentials
$stmt = $pdo->prepare("SELECT * FROM users WHERE uName = :username AND pWord = :password");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Change to use 'uid' as the session variable name to match other pages
    $_SESSION['uid'] = $user['uid']; 
    $_SESSION['username'] = $user['uName'];
    
    session_write_close();
    header("Location: /access/land.php");
    exit;
} else {
    // Handle failed login
    header("Location: /access/login.php?error=1");
    exit;
}
?>