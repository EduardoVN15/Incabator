<?php
// Start the session to access session variables - moved to top before any output
session_start();

// Check the session for debugging
// Uncomment the next lines if you need to debug session issues

//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Schedule Form</title>
    
    <?php 
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

        // Initialize variables for existing data
        $class1 = '';
        $teacher1 = '';
        $room1 = '';
        $loggedInStudentId = 0;

        // Check if the user is logged in by checking the session for uid
        if (isset($_SESSION['uid'])) {
            $loggedInStudentId = $_SESSION['uid'];
            
            // Check if user has an existing schedule
            $stmt = $pdo->prepare("SELECT p1c, p1t, p1r FROM schedules WHERE uid = :uid");
            $stmt->bindParam(':uid', $loggedInStudentId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                $class1 = $result['p1c'] ?? '';
                $teacher1 = $result['p1t'] ?? '';
                $room1 = $result['p1r'] ?? '';
            }
//        } else {
//            // Redirect to login instead of showing error
//            header("Location: /access/login.php");
//            exit;
        }
    ?>
</head>
<body>
    <div class="container">
        <div class="schedule-form">
            <h2 class="schedule-title">Class Schedule</h2>
            <form method="POST" action="/users/scheduleHandler.php">
                <!-- Pass the studentID (from session) as a hidden input -->
                <input type="hidden" name="studentID" value="<?php echo $loggedInStudentId; ?>">
                
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
                        <!-- Only Period 1 -->
                        <tr>
                            <td>1</td>
                            <td><input type="text" name="class1" id="class1" class="form-control" value="<?php echo htmlspecialchars($class1); ?>" required></td>
                            <td><input type="text" name="teacher1" id="teacher1" class="form-control" value="<?php echo htmlspecialchars($teacher1); ?>" required></td>
                            <td><input type="text" name="room1" id="room1" class="form-control" value="<?php echo htmlspecialchars($room1); ?>" required></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Submit Schedule</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>