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

    // Get submitted username and password from the login form
    $name = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL query to find the user by username
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE uName = :username");
    $stmt->bindParam(':username', $name, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($password === $user['pWord']) {
            // Redirect to profile.php with user details in the URL
            header("Location: /access/profile.php?username=" . urlencode($user['uName']) . "&email=" . urlencode($user['email']) . "&regDate=" . urlencode($user['regDate']));
            exit();
        } else {
            echo "Error: Incorrect password.";
        }
    } else {
        echo "Error: Username not found.";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
