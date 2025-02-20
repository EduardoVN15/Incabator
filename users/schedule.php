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
        session_start();
        include $_SERVER['DOCUMENT_ROOT'] . '/access/nav.php';
    ?>
  test
</head>
<body>
    <div class="container">
        <div class="schedule-form">
            <h2 class="schedule-title">Class Schedule</h2>
            <form method="POST" action="/users/scheduleHandler.php">
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
                        <!-- Period 1 -->
                        <tr>
                            <td>1</td>
                            <td><input type="text" name="class1" id="class1" class="form-control" required></td>
                            <td><input type="text" name="teacher1" id="teacher1" class="form-control" required></td>
                            <td><input type="text" name="room1" id="room1" class="form-control" required></td>
                        </tr>
                        <!-- Period 2 -->
                        <tr>
                            <td>2</td>
                            <td><input type="text" name="class2" id="class2" class="form-control" required></td>
                            <td><input type="text" name="teacher2" id="teacher2" class="form-control" required></td>
                            <td><input type="text" name="room2" id="room2" class="form-control" required></td>
                        </tr>
                        <!-- Period 3 -->
                        <tr>
                            <td>3</td>
                            <td><input type="text" name="class3" id="class3" class="form-control" required></td>
                            <td><input type="text" name="teacher3" id="teacher3" class="form-control" required></td>
                            <td><input type="text" name="room3" id="room3" class="form-control" required></td>
                        </tr>
                        <!-- Period 4 -->
                        <tr>
                            <td>4</td>
                            <td><input type="text" name="class4" id="class4" class="form-control" required></td>
                            <td><input type="text" name="teacher4" id="teacher4" class="form-control" required></td>
                            <td><input type="text" name="room4" id="room4" class="form-control" required></td>
                        </tr>
                        <!-- Period 5 -->
                        <tr>
                            <td>5</td>
                            <td><input type="text" name="class5" id="class5" class="form-control" required></td>
                            <td><input type="text" name="teacher5" id="teacher5" class="form-control" required></td>
                            <td><input type="text" name="room5" id="room5" class="form-control" required></td>
                        </tr>
                        <!-- Period 6 -->
                        <tr>
                            <td>6</td>
                            <td><input type="text" name="class6" id="class6" class="form-control" required></td>
                            <td><input type="text" name="teacher6" id="teacher6" class="form-control" required></td>
                            <td><input type="text" name="room6" id="room6" class="form-control" required></td>
                        </tr>
                        <!-- Period 7 -->
                        <tr>
                            <td>7</td>
                            <td><input type="text" name="class7" id="class7" class="form-control" required></td>
                            <td><input type="text" name="teacher7" id="teacher7" class="form-control" required></td>
                            <td><input type="text" name="room7" id="room7" class="form-control" required></td>
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

