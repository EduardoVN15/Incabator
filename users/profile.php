<?php
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

include $_SERVER['DOCUMENT_ROOT'] . '/access/nav.php';

// Check if the user is logged in
if (!isset($_SESSION['uid'])) {
    echo "<p class='error-message'>Please log in to view your schedule.</p>";
    exit();
}

$uid = $_SESSION['uid']; // Get logged-in user's ID

// Fetch the schedule for the logged-in user
$query = "SELECT * FROM schedules WHERE uid = :uid";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
$stmt->execute();

// Check if a schedule exists
if ($stmt->rowCount() === 0) {
    echo "<p class='error-message'>No schedule found.</p>";
    exit();
}

$schedule = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Schedule</title>
    <link rel="stylesheet" href="/css/styles.css"> <!-- Keep your existing CSS link -->
    <style>
        /* Inline Schedule Styles */
        .container.schedule-page {
            width: min(90%, 650px);
            padding: 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: #333;
            margin: 1rem auto;
            box-sizing: border-box;
        }
        
        .schedule-container {
            width: 100%;
            margin-top: 1.5rem;
            border: none;
            padding: 0;
            background: transparent;
        }
        
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .schedule-table th, .schedule-table td {
            padding: 0.8rem;
            text-align: left;
            border: 1px solid #e1e1e1;
            color: #333;
        }
        
        .schedule-table th {
            background: linear-gradient(45deg, #1F0E58, #004EA9);
            color: white;
            font-weight: 500;
        }
        
        .schedule-table tr:nth-child(even) {
            background-color: #f8f8f8;
        }
        
        .schedule-table tr:hover {
            background-color: #f0f0f0;
        }
        
        .error-message {
            color: #d9534f;
            background-color: #f9eaea;
            border: 1px solid #d9534f;
            padding: 0.8rem;
            border-radius: 8px;
            margin: 1rem 0;
            text-align: center;
        }
        
        h1.schedule-title {
            font-size: 2rem;
            margin: 0 0 1.5rem 0;
            color: #1F0E58;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container schedule-page">
        <h1 class="schedule-title">Your Profile</h1>
        <div class="schedule-container">
            <table class="schedule-table">
                <tr>
                    <th>Period</th>
                    <th>Class</th>
                    <th>Teacher</th>
                    <th>Room</th>
                </tr>
                <?php
                // Loop through periods 1-7 dynamically
                for ($i = 1; $i <= 7; $i++) {
                    $class = $schedule["p{$i}c"] ?? 'Not assigned';
                    $teacher = $schedule["p{$i}t"] ?? 'Not assigned';
                    $room = $schedule["p{$i}r"] ?? 'Not assigned';
                    echo "<tr>
                            <td>Period $i</td>
                            <td>$class</td>
                            <td>$teacher</td>
                            <td>$room</td>
                          </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
