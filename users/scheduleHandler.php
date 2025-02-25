<?php
// Enable error reporting for debugging
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dump the POST data to check the values
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    
    // Extract student ID
    $studentID = $_POST['studentID'];
    
    // Prepare SQL statement
    $stmt = $pdo->prepare("INSERT INTO schedules (studentID, period, class, teacher, room) 
                           VALUES (:studentID, :period, :class, :teacher, :room)");
    
    // Loop through periods 1 to 7 and insert each class into the database
    for ($i = 1; $i <= 7; $i++) {
        $classKey = "class" . $i;
        $teacherKey = "teacher" . $i;
        $roomKey = "room" . $i;
        
        if (isset($_POST[$classKey], $_POST[$teacherKey], $_POST[$roomKey])) {
            $class = $_POST[$classKey];
            $teacher = $_POST[$teacherKey];
            $room = $_POST[$roomKey];
            
            // Debugging: Output values before executing the query
            echo "Inserting: Period $i | Class: $class | Teacher: $teacher | Room: $room <br>";
            
            // Execute the prepared statement
            if (!$stmt->execute([
                ':studentID' => $studentID,
                ':period' => $i,
                ':class' => $class,
                ':teacher' => $teacher,
                ':room' => $room
            ])) {
                die("Error inserting: " . implode(" | ", $stmt->errorInfo()));
            }
        }
    }
    
    echo "Schedule saved successfully!";
    // Redirect to land.php after successful save
    header("Location: /access/land.php");
    exit;
} else {
    echo "Invalid request!";
}
?>