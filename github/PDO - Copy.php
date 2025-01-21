<?php
$host = 'auth-db1536.hstgr.io';
$dbname = 'u237055794_schoolMaps';
$username = 'u237055794_ghs_schoolMaps';
$password = 'ZwbHRi^4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
