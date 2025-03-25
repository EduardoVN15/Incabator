<?php
// Start session
session_start();

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

// Check if session contains user data
if (!isset($_SESSION['uid'])) {
    echo "No user data found in session.";
    exit;
}

//// Display session data
//echo "<pre>";
//print_r($_SESSION['users']);
//echo "</pre>";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";


$uid = $_SESSION['uid']; // Ensure $uid is set from session

// Fetch the schedule for the logged-in user
try {
    $query = "SELECT * FROM schedules WHERE uid = :uid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
    $stmt->execute();
    
    echo "<p>Debugging: Query executed</p>";
    
    // Check if a schedule exists
    if ($stmt->rowCount() === 0) {
        echo "<p>No schedule found for uid: $uid</p>";
        
        // Show the table structure
        $tableQuery = "DESCRIBE schedules";
        $tableStmt = $pdo->prepare($tableQuery);
        $tableStmt->execute();
        $columns = $tableStmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<p>Table structure:</p>";
        echo "<pre>";
        print_r($columns);
        echo "</pre>";
        
        exit();
    } else {
        $schedule = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<p>Debugging: Schedule found</p>";
    }
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

// Display the schedule data for debugging
echo "<p>Debugging: Schedule data:</p>";
echo "<pre>";
print_r($schedule);
echo "</pre>";


///////////////////////////////////////////////USERS!!!!!!!!!!!!!!!!!!!!!!!!!!


try {
    $query = "SELECT * FROM users WHERE uid = :uid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
    $stmt->execute();
    
    echo "<p>Debugging: Query executed</p>";
    
    // Check if a schedule exists
    if ($stmt->rowCount() === 0) {
        echo "<p>No user found for uid: $uid</p>";
        
        // Show the table structure
        $tableQuery1 = "DESCRIBE users";
        $tableStmt1 = $pdo->prepare($tableQuery1);
        $tableStmt1->execute();
        $columns1 = $tableStmt1->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<p>Table structure:</p>";
        echo "<pre>";
        print_r($columns1);
        echo "</pre>";
        
        exit();
    } else {
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<p>Debugging: user found</p>";
    }
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

echo "<p>Debugging: user data:</p>";
echo "<pre>";
print_r($users);
echo "</pre>";





//$sql = "SELECT * FROM users LIMIT 1"; // Fetch one row
//$result = $conn->query($sql);
//
//if ($result) {
//    if ($result->num_rows > 0) {
//        echo "Users table is accessible! Here's a sample row:<br>";
//        $row = $result->fetch_assoc();
//        print_r($row); // Display the data
//    } else {
//        echo "Query executed, but no users found.";
//    }
//} else {
//    echo "Error: " . $conn->error;
//}




?>