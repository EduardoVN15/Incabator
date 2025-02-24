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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dump the POST data to check the values
    var_dump($_POST);

    // Get studentID ID from session (assuming studentID is logged in)
    // Since we're not using sessions now, you could manually check the studentID
    $studentID = isset($_POST['studentID']) ? $_POST['studentID'] : null;

    // Dump studentID to check if it's available
    var_dump($studentID);

    if (!$studentID) {
        die("studentID not authenticated.");
    }

    // Prepare SQL statement
    $stmt = $pdo->prepare("INSERT INTO schedules (studentID_id, period, class_name, teacher, room_number) VALUES (:studentID_id, :period, :class, :teacher, :room)");

    // Loop through periods 1-7 and insert into the database
    for ($i = 1; $i <= 7; $i++) {
        $class = isset($_POST["class$i"]) ? $_POST["class$i"] : '';
        $teacher = isset($_POST["teacher$i"]) ? $_POST["teacher$i"] : '';
        $room = isset($_POST["room$i"]) ? $_POST["room$i"] : '';

        if (!empty($class) && !empty($teacher) && !empty($room)) {
            $stmt->execute([
                ':studentID_id' => $studentID,
                ':period' => $i,
                ':class' => $class,
                ':teacher' => $teacher,
                ':room' => $room
            ]);
        }
    }

    // Redirect after successful submission
    header("Location: /access/land.php?success=1");
    exit();
} else {
    die("Invalid request.");
}
?>
