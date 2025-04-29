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
    echo "<p class='error-message'>Please log in to view your profile.</p>";
    exit();
}

$uid = $_SESSION['uid']; // Get logged-in user's ID

// Fetch the user information
try {
    $userQuery = "SELECT uName, fullName, email, studentID, grade FROM users WHERE uid = :uid";
    $userStmt = $pdo->prepare($userQuery);
    $userStmt->bindParam(':uid', $uid, PDO::PARAM_INT);
    $userStmt->execute();

    if ($userStmt->rowCount() === 0) {
        echo "<p class='error-message'>No user information found.</p>";
        exit();
    }

    $users = $userStmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("User query failed: " . $e->getMessage());
}

// Fetch the schedule for the logged-in user (now optional)
$schedule = null;
try {
    $scheduleQuery = "SELECT * FROM schedules WHERE uid = :uid";
    $scheduleStmt = $pdo->prepare($scheduleQuery);
    $scheduleStmt->bindParam(':uid', $uid, PDO::PARAM_INT);
    $scheduleStmt->execute();

    if ($scheduleStmt->rowCount() > 0) {
        $schedule = $scheduleStmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    die("Schedule query failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="stylesheet" href="/css2/styles.css"> 
    <style>
        .container.profile-page {
            width: min(90%, 650px);
            padding: 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: #333;
            margin: 1rem auto;
            box-sizing: border-box;
        }
        .profile-table, .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .profile-table th, .profile-table td, 
        .schedule-table th, .schedule-table td {
            padding: 0.8rem;
            text-align: left;
            border: 1px solid #e1e1e1;
            color: #333;
        }
        .profile-table th, .schedule-table th {
            background: linear-gradient(45deg, #1F0E58, #004EA9);
            color: white;
            font-weight: 500;
        }
        .schedule-table tr:nth-child(even),
        .profile-table tr:nth-child(even) {
            background-color: #f8f8f8;
        }
        .error-message {
            color: #d9534f;
            background-color: #f9eaea;
            border: 1px solid #d9534f;
            padding: 0.8rem;
            border-radius: 8px;
            text-align: center;
        }
        h1.profile-title {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #1F0E58;
            text-align: center;
        }
		  .no-schedule-message {
            color: #666;
            font-style: italic;
            text-align: center;
            padding: 1rem;
            background-color: #f4f4f4;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container profile-page">
        <h1 class="profile-title">Your Profile</h1>

        <!-- User Information Table -->
        <table class="profile-table">
			
			
			<tr>
    <th>Full Name</th>
    <td><?= htmlspecialchars($users['fullName'] ?? 'Not available') ?></td>
</tr>
			
            <tr>
                <th>User Name</th>
                <td><?= htmlspecialchars($users['uName'] ?? 'Not available') ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($users['email'] ?? 'Not available') ?></td>
            </tr>
            <tr>
                <th>Student ID</th>
                <td><?= htmlspecialchars($users['studentID'] ?? 'Not available') ?></td>
            </tr>
            <tr>
                <th>Grade</th>
                <td><?= htmlspecialchars($users['grade'] ?? 'Not available') ?></td>
            </tr>
        </table>

        <!-- Schedule Table -->
        <table class="schedule-table">
            <tr>
                <th>Period</th>
                <th>Class</th>
                <th>Teacher</th>
                <th>Room</th>
            </tr>
            <?php if ($schedule): ?>
                <?php for ($i = 1; $i <= 7; $i++): ?>
                    <tr>
                        <td>Period <?= $i ?></td>
                        <td><?= htmlspecialchars($schedule["p{$i}c"] ?? 'Not assigned') ?></td>
                        <td><?= htmlspecialchars($schedule["p{$i}t"] ?? 'Not assigned') ?></td>
                        <td><?= htmlspecialchars($schedule["p{$i}r"] ?? 'Not assigned') ?></td>
                    </tr>
                <?php endfor; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="no-schedule-message">
                        No schedule has been assigned yet. Please input your schedule.
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>