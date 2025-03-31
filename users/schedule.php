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

$loggedInStudentId = $_SESSION['uid'] ?? 0;
$schedule = [];

// Fetch the existing schedule
if ($loggedInStudentId) {
    $stmt = $pdo->prepare("SELECT * FROM schedules WHERE uid = :uid");
    $stmt->bindParam(':uid', $loggedInStudentId, PDO::PARAM_INT);
    $stmt->execute();
    $schedule = $stmt->fetch(PDO::FETCH_ASSOC) ?? [];
}

// Fetch period times
$stmt = $pdo->query("SELECT * FROM period_times ORDER BY period_number");
$periodTimes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$periodTimeMap = [];
foreach ($periodTimes as $row) {
    $periodTimeMap[$row['period_number']] = date("g:i A", strtotime($row['start_time'])) . " - " . date("g:i A", strtotime($row['end_time']));
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="/css/styles.css"> 
    <title>Schedule Form</title>
	
	
	
	
	
	<script>
    function confirmUpdate(event) {
        var hasExistingSchedule = <?php echo !empty($schedule) ? 'true' : 'false'; ?>;
        if (hasExistingSchedule) {
            var confirmUpdate = confirm("You already have a schedule saved. Are you sure you want to update it?");
            if (!confirmUpdate) {
                event.preventDefault(); // Stop form submission if the user cancels
            }
        }
    }
</script>
	
	
	
	
	
</head>
<body>
    <div class="container schedule-page">
        <div class="schedule-form">
            <h2 class="schedule-title">My Schedule</h2>
            <form method="POST" action="/users/scheduleHandler.php">
                <input type="hidden" name="studentID" value="<?php echo $loggedInStudentId; ?>">
				

               <table class="table table-bordered">
    <thead>
        <tr>
            <th>Period</th>
            <th>Time</th>
            <th>Class</th>
            <th>Teacher</th>
            <th>Room Number</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 1; $i <= 7; $i++): ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $periodTimeMap[$i] ?? 'N/A'; ?></td>
            <td><input type="text" name="class<?php echo $i; ?>" class="form-control" value="<?php echo htmlspecialchars($schedule["p{$i}c"] ?? ''); ?>" required></td>
            <td><input type="text" name="teacher<?php echo $i; ?>" class="form-control" value="<?php echo htmlspecialchars($schedule["p{$i}t"] ?? ''); ?>" required></td>
            <td><input type="text" name="room<?php echo $i; ?>" class="form-control" value="<?php echo htmlspecialchars($schedule["p{$i}r"] ?? ''); ?>" required></td>
        </tr>
        <?php endfor; ?>
    </tbody>
</table>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary" onclick="confirmUpdate(event)">Submit Schedule</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
