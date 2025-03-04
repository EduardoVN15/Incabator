<?php
session_start(); // Start session to access user_id

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in."); // You can replace this with a redirect if preferred
}

$userId = $_SESSION['user_id']; // Get the logged-in user ID

// Database connection (using MySQLi)
$host = 'auth-db1536.hstgr.io';
$dbname = 'u237055794_schoolMaps';
$dbUsername = 'u237055794_ghs_schoolMaps';
$dbPassword = 'ZwbHRi^4';

// Create a MySQLi connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if schedule data was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure schedule data is received
    if (!isset($_POST['schedule'])) {
        die("No schedule data received.");
    }

    // Decode the JSON string into an associative array
    $decodedSchedule = json_decode($_POST['schedule'], true);

    // Check if JSON decoding was successful
    if (json_last_error() !== JSON_ERROR_NONE) {
        die("Invalid schedule format: " . json_last_error_msg());
    }

    // Re-encode the validated JSON data
    $jsonSchedule = json_encode($decodedSchedule, JSON_UNESCAPED_UNICODE);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO schedules (user_id, schedule) 
                            VALUES (?, ?) 
                            ON DUPLICATE KEY UPDATE schedule = ?");
    
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("iss", $userId, $jsonSchedule, $jsonSchedule);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Schedule saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
