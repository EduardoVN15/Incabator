<?php
// Start the session at the very top of the file
session_start();



// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Uncomment for session debugging

//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';


// Database configuration
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

// Check if the user is logged in by checking the session for uid
if (isset($_SESSION['uid'])) {
    $userId = $_SESSION['uid'];
//} else {
//    // Redirect to login page if not logged in
//    header("Location: /access/login.php");
//    exit;
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract individual period 1 values
    $p1c = $_POST['class1'] ?? '';
    $p1t = $_POST['teacher1'] ?? '';
    $p1r = $_POST['room1'] ?? '';

    // Check if user already has a schedule
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM schedules WHERE uid = :uid");
    $checkStmt->bindParam(':uid', $userId, PDO::PARAM_INT);
    $checkStmt->execute();
    
    if ($checkStmt->fetchColumn() > 0) {
        // Update existing schedule
        $stmt = $pdo->prepare("UPDATE schedules SET p1c = :p1c, p1t = :p1t, p1r = :p1r WHERE uid = :uid");
    } else {
        // Insert new schedule
        $stmt = $pdo->prepare("INSERT INTO schedules (uid, p1c, p1t, p1r) VALUES (:uid, :p1c, :p1t, :p1r)");
    }

    // Bind parameters and execute
    $stmt->bindParam(':uid', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':p1c', $p1c, PDO::PARAM_STR);
    $stmt->bindParam(':p1t', $p1t, PDO::PARAM_STR);
    $stmt->bindParam(':p1r', $p1r, PDO::PARAM_STR);
    
    try {
        if ($stmt->execute()) {
            // Re-establish session before redirect to ensure persistence
            session_write_close();
            
            // Redirect to land.php after successful save
            header("Location: /access/land.php");
            exit;
        } else {
            echo "Error saving schedule: " . implode(" | ", $stmt->errorInfo());
        }
    } catch (PDOException $e) {
        // Display detailed error for debugging
        echo "PDO Error: " . $e->getMessage() . "<br>";
        echo "Error Code: " . $e->getCode() . "<br>";
        echo "SQL Query: " . $stmt->queryString . "<br>";
        echo "Please contact your administrator with this information.";
    }
} else {
    echo "Invalid request!";
}
?>