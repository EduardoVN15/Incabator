<?php
$host = 'auth-db1536.hstgr.io';
$dbname = 'u237055794_schoolMaps';
$username = 'u237055794_ghs_schoolMaps';
$password = 'ZwbHRi^4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Define the username you want to search for
    $searchUsername = 'eduardo'; // Replace 'desiredUsername' with the actual username you want to query
    
    // Prepare and execute the query
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE uName = :username");
    $stmt->bindParam(':username', $searchUsername, PDO::PARAM_STR);
    $stmt->execute();
    
    // Fetch the user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        print_r($user); // Print the user data (for debugging purposes)
    } else {
        echo "User not found.";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

