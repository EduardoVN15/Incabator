<?php
function getDatabaseConnection() {
    $host = 'auth-db1536.hstgr.io';
    $dbname = 'u237055794_schoolMaps';
    $dbUsername = 'u237055794_ghs_schoolMaps';
    $dbPassword = 'ZwbHRi^4';

    try {
        // Establish database connection
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbUsername, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        // Handle connection error
        echo "Connection failed: " . $e->getMessage();
        exit();
    }
}
?>
