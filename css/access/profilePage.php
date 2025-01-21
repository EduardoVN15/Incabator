<?php
// Database connection details
$host = 'auth-db1536.hstgr.io';
$dbname = 'u237055794_schoolMaps';
$dbUsername = 'u237055794_ghs_schoolMaps';
$dbPassword = 'ZwbHRi^4';

try {
    // Establish database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if user parameter is set in the URL
    if (isset($_GET['user'])) {
        $username = $_GET['user'];

        // Prepare SQL query to find the user by username
        $stmt = $pdo->prepare("SELECT * FROM Users WHERE uName = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vardump GET parameters
        echo "GET Parameters:\n";
        var_dump($_GET);
        echo "\n\n";

        // Vardump user data
        echo "User Data:\n";
        var_dump($user);
        echo "\n\n";

        // Additional data dump from other tables if needed
        // For example, if you want to get student details
        $stmt = $pdo->prepare("SELECT * FROM Students WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $studentDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "Student Details:\n";
        var_dump($studentDetails);
        echo "\n\n";

    } else {
        echo "No user specified";
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>