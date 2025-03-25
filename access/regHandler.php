<?php session_start(); 
require_once('../database/dbConnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$fullName = trim($_POST['fullName']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);
    $grade = trim($_POST['grade']);
    $studentId = trim($_POST['studentId']);

    $errors = [];
if (empty($fullName)) $errors[] = "Full name is required.";
    if (empty($username)) $errors[] = "Username is required.";
    if (empty($email)) $errors[] = "Email is required.";
    if (empty($password)) $errors[] = "Password is required.";
    if (empty($grade)) $errors[] = "Grade level is required.";
    if (empty($studentId)) $errors[] = "Student ID is required.";
    if ($password !== $confirmPassword) $errors[] = "Passwords do not match.";
    if (!preg_match('/^[0-9]{6}$/', $studentId)) $errors[] = "Student ID must be 6 digits.";

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: registration.php");
        exit();
    }

    try {
        // Modify the SQL query to include grade and studentId
$stmt = $pdo->prepare("INSERT INTO users (fullName, uName, email, pWord, grade, studentId) 
VALUES (:fullName, :username, :email, :password, :grade, :studentId)");

$stmt->bindParam(':fullName', $fullName, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':grade', $grade, PDO::PARAM_INT);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_STR);

        $stmt->execute();
        
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>