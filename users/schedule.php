<?php
session_start(); // Start session at the top

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in."); // You can replace this with a redirect if preferred
}

$userId = $_SESSION['user_id']; // Get the logged-in user ID

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
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Schedule Form</title>
</head>
<body>
    <div class="container">
        <div class="schedule-form">
            <h2 class="schedule-title">Class Schedule</h2>
            <form method="POST" action="/users/scheduleHandler.php" id="scheduleForm">
                
                <!-- Pass the dynamically retrieved user ID -->
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userId); ?>">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Period</th>
                            <th>Class</th>
                            <th>Teacher</th>
                            <th>Room Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($period = 1; $period <= 7; $period++): ?>
                        <tr>
                            <td><?php echo $period; ?></td>
                            <td><input type="text" name="class<?php echo $period; ?>" id="class<?php echo $period; ?>" class="form-control" required></td>
                            <td><input type="text" name="teacher<?php echo $period; ?>" id="teacher<?php echo $period; ?>" class="form-control" required></td>
                            <td><input type="text" name="room<?php echo $period; ?>" id="room<?php echo $period; ?>" class="form-control" required></td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Submit Schedule</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('scheduleForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent normal form submission

            let scheduleData = {};
            for (let period = 1; period <= 7; period++) {
                let className = document.getElementById('class' + period).value;
                let teacherName = document.getElementById('teacher' + period).value;
                let roomNumber = document.getElementById('room' + period).value;
                scheduleData[period] = {
                    class: className,
                    teacher: teacherName,
                    room: roomNumber
                };
            }

            let jsonSchedule = JSON.stringify(scheduleData);

            let scheduleInput = document.createElement('input');
            scheduleInput.type = 'hidden';
            scheduleInput.name = 'schedule';
            scheduleInput.value = jsonSchedule;
            this.appendChild(scheduleInput);

            this.submit();
        });
    </script>
</body>
</html>
