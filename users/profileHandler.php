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

echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// Check if the user is logged in - check both possible session variables
if (!isset($_SESSION['uid'])) {
    echo "<p>Please log in to view your schedule. No user ID found in session.</p>";
    exit();
}

// Fetch the schedule for the logged-in user
try {
    $query = "SELECT * FROM schedules WHERE user_id = :uid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
    $stmt->execute();
    
    echo "<p>Debugging: Query executed</p>";
    
    // Check if a schedule exists
    if ($stmt->rowCount() === 0) {
        echo "<p>No schedule found for user ID: $uid</p>";
        
        // Try with the other column name if the first one fails
        $query2 = "SELECT * FROM schedules WHERE uid = :uid";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam(':uid', $uid, PDO::PARAM_INT);
        $stmt2->execute();
        
        if ($stmt2->rowCount() === 0) {
            echo "<p>No schedule found with uid column either.</p>";
            
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
            echo "<p>Schedule found using uid column instead of user_id</p>";
            $schedule = $stmt2->fetch(PDO::FETCH_ASSOC);
        }
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
?>
