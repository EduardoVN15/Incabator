<?php

require_once('../database/dbConnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    error_reporting(E_ALL); // Show all errors
    ini_set('display_errors', 1); // Display errors on screen

    // Debug: Check if POST data is received
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Capture input
    // Capture input
	$username = isset($_POST['username']) ? trim($_POST['username']) : '';
	$email = isset($_POST['email']) ? trim($_POST['email']) : '';
	$password = isset($_POST['password']) ? trim($_POST['password']) : '';
	$confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';
	$studentId = isset($_POST['studentId']) ? trim($_POST['studentId']) : '';
	$grade = isset($_POST['grade']) ? trim($_POST['grade']) : '';

    $errors = [];

    // Validate input
    if (empty($username)) $errors[] = "Username is required.";
    if (empty($email)) $errors[] = "Email is required.";
    if (empty($password)) $errors[] = "Password is required.";
    if ($password !== $confirmPassword) $errors[] = "Passwords do not match.";
    if (empty($studentId)) $errors[] = "Student ID is required.";
    if (empty($grade)) $errors[] = "Grade is required.";

    // Debug: Display errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: /access/register.php");
        exit();
    }

    try {
        // Debug: Check database connection
        if (!$pdo) {
            die("Database connection failed.");
        }

        // Debug: Check prepared statement
        $stmt = $pdo->prepare("INSERT INTO Users (uName, email, pWord, studentId, grade) 
                               VALUES (:username, :email, :password, :studentId, :grade)");

        if (!$stmt) {
            die("Failed to prepare statement.");
        }

        // Debug: password before storing
        $Password = password($password, PASSWORD_DEFAULT);

        // Bind parameters
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $Password, PDO::PARAM_STR);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->bindParam(':grade', $grade, PDO::PARAM_INT);

        // Execute and check for errors
        if ($stmt->execute()) {
    $_SESSION['success'] = "Registration successful! Please log in.";
    header("Location: /access/login.php");
    exit();
} else {
    $_SESSION['errors'] = ["Failed to register user."];
    header("Location: /access/register.php");
    exit();
}
    } catch (PDOException $e) {
        // Log the error
        error_log("Database error: " . $e->getMessage());
        die("Database error: " . $e->getMessage());
    }
}
?>
