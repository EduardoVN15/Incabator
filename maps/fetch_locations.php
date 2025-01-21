<?php
// Directly include database credentials
$servername = "auth-db1536.hstgr.io";
$username = "u237055794_ghs_schoolMaps";
$password = "ZwbHRi^4";
$dbname = "u237055794_schoolMaps";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query locations
$sql = "SELECT name, type, latitude, longitude, boundary FROM Locations";
$result = $conn->query($sql);

// Initialize an empty array to hold location data
$locations = [];

if ($result->num_rows > 0) {
    // Loop through the results
    while ($row = $result->fetch_assoc()) {
        $locations[] = [
            'name' => $row['name'],
            'type' => $row['type'],
            'latitude' => $row['latitude'], // For classrooms or point-based locations
            'longitude' => $row['longitude'], // For classrooms or point-based locations
            'boundary' => json_decode($row['boundary']) // Decode boundary JSON if present
        ];
    }
}

// Return JSON
header('Content-Type: application/json'); // Ensure the response is JSON
echo json_encode($locations); // Output the locations array as JSON

// Close the database connection
$conn->close();
?>
