<?php


require_once('../database/dbConnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);
	

    $errors = [];

    if (empty($username)) $errors[] = "Username is required.";
    if (empty($email)) $errors[] = "Email is required.";
    if (empty($password)) $errors[] = "Password is required.";
    if ($password !== $confirmPassword) $errors[] = "Passwords do not match.";


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: registration.php");
        exit();
    }

    try {
    $stmt = $pdo->prepare("INSERT INTO Users (uName, email, pWord) VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
	

    $stmt->execute();
    header("Location: login.php");
    exit();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
}
?>
