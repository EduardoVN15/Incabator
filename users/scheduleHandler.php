<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'auth-db1536.hstgr.io';
$dbname = 'u237055794_schoolMaps';
$dbUsername = 'u237055794_ghs_schoolMaps';
$dbPassword = 'ZwbHRi^4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (isset($_SESSION['uid'])) {
    $userId = $_SESSION['uid'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scheduleData = [];
    
    for ($i = 1; $i <= 7; $i++) {
        $scheduleData["p{$i}c"] = $_POST["class$i"] ?? '';
        $scheduleData["p{$i}t"] = $_POST["teacher$i"] ?? '';
        $scheduleData["p{$i}r"] = $_POST["room$i"] ?? '';
    }

    // Check if user already has a schedule
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM schedules WHERE uid = :uid");
    $checkStmt->bindParam(':uid', $userId, PDO::PARAM_INT);
    $checkStmt->execute();

    if ($checkStmt->fetchColumn() > 0) {
        // Update query
        $updateQuery = "UPDATE schedules SET ";
        $updateParts = [];

        foreach ($scheduleData as $column => $value) {
            $updateParts[] = "$column = :$column";
        }

        $updateQuery .= implode(", ", $updateParts) . " WHERE uid = :uid";
        $stmt = $pdo->prepare($updateQuery);
    } else {
        // Insert query
        $columns = implode(", ", array_keys($scheduleData));
        $placeholders = ":" . implode(", :", array_keys($scheduleData));

        $stmt = $pdo->prepare("INSERT INTO schedules (uid, $columns) VALUES (:uid, $placeholders)");
    }

    // Bind parameters
    $stmt->bindParam(':uid', $userId, PDO::PARAM_INT);
    foreach ($scheduleData as $column => &$value) {
        $stmt->bindParam(":$column", $value, PDO::PARAM_STR);
    }

    try {
        if ($stmt->execute()) {
            session_write_close();
            header("Location: /access/land.php");
            exit;
        } else {
            echo "Error saving schedule: " . implode(" | ", $stmt->errorInfo());
        }
    } catch (PDOException $e) {
        echo "PDO Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request!";
}
