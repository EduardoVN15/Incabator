

<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/access/nav.php';
?>









<?php
// Require the database connection file
require_once 'database/dbConnection.php';

$uid = 2; // Replace with the desired user ID

$stmt = $pdo->prepare("SELECT email FROM Users WHERE uid = :uid");
$stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
$stmt->execute(); // Add this line to execute the statement
$email = $stmt->fetchColumn();

echo "Email for user ID $uid: $email";
?>