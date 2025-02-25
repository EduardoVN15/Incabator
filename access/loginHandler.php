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

if ($user) {
    $_SESSION['user_id'] = $user['uid']; // Change from $user['id'] to $user['uid']
    $_SESSION['username'] = $user['uName'];

    session_write_close();
    header("Location: /access/land.php");
    exit;
}

?>