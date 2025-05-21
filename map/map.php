<?php
session_start();

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

// Fetch the logged-in user's schedule
$userSchedule = [];
if (isset($_SESSION['uid'])) {
    $stmt = $pdo->prepare("SELECT * FROM schedules WHERE uid = :uid");
    $stmt->bindParam(':uid', $_SESSION['uid'], PDO::PARAM_INT);
    $stmt->execute();
    $schedule = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($schedule) {
    // Define a mapping of rooms to buildings
    // Define a mapping of rooms to buildings
    $roomToBuilding = [
        // English building rooms (1400 block)
        '1401' => 'English/1400',
        '1402' => 'English/1400',
        '1403' => 'English/1400',
        '1404' => 'English/1400',
        '1405' => 'English/1400',
        '1406' => 'English/1400',
        '1407' => 'English/1400', // Spanish
        '1408' => 'English/1400',
        '1409' => 'English/1400', // Special Ed/Mental Health
        '1411' => 'English/1400', // Spanish
        '1412' => 'English/1400', // Spanish
        '1413' => 'English/1400', // Spanish
        '1414' => 'English/1400', // Spanish
        '1416' => 'English/1400', // Special Ed
        '1417' => 'English/1400', // Mental Health
        '1419' => 'English/1400', // Special Ed/Transition
        '1451' => 'English/1400',
        '1452' => 'English/1400',
        '1453' => 'English/1400',
        '1454' => 'English/1400',
        '1455' => 'English/1400', // ERHMS Therapist
        '1456' => 'English/1400', // Special Ed
        '1457' => 'English/1400',
        '1458' => 'English/1400',
        '1459' => 'English/1400',
        '1461' => 'English/1400', // Special Ed
        '1462' => 'English/1400',
        '1463' => 'English/1400',
        '1464' => 'English/1400',
        '1466' => 'English/1400',
        '1467' => 'English/1400',
        '1468' => 'English/1400', // Special Ed
        '1469' => 'English/1400', // Special Ed
        
        // Art/Office building rooms (200 block)
        '200' => 'Art/Office/200', // Social Science/ASB
        '201' => 'Art/Office/200',
        '202' => 'Art/Office/200',
        '203' => 'Art/Office/200',
        '204' => 'Art/Office/200',
        '205' => 'Art/Office/200', // Metals
        '210' => 'Art/Office/200', // Art
        '220' => 'Art/Office/200', // Mental Health/Severely Handicapped
        '225' => 'Art/Office/200', // Photo/Digital Arts
        '230' => 'Art/Office/200', // Art
        
        // Bio/Science building rooms (1100 block)
        '1101' => 'Bio/Science/1100',
        '1102' => 'Bio/Science/1100',
        '1103' => 'Bio/Science/1100',
        '1104' => 'Bio/Science/1100',
        '1105' => 'Bio/Science/1100', // Science
        '1110' => 'Bio/Science/1100', // Science
        '1115' => 'Bio/Science/1100', // Science
        '1120' => 'Bio/Science/1100', // Science
        '1125' => 'Bio/Science/1100', // Biology/APES
        '1130' => 'Bio/Science/1100', // Chemistry/Special Ed
        '1135' => 'Bio/Science/1100', // Chemistry
        '1140' => 'Bio/Science/1100', // PLTW-Engineering
        '1145' => 'Bio/Science/1100', // Physics
        '1150' => 'Bio/Science/1100', // Chemistry
        
        // Math/Library building rooms (600 block)
        '550' => 'Math/Library/600', // Math/Special Ed
        '555' => 'Math/Library/600', // Social Science
        '560' => 'Math/Library/600', // Speech Language
        '601' => 'Math/Library/600',
        '602' => 'Math/Library/600',
        '603' => 'Math/Library/600',
        '604' => 'Math/Library/600',
        '605' => 'Math/Library/600',
        '610' => 'Math/Library/600', // NJROTC
        '620' => 'Math/Library/600', // NJROTC
        
        // Math 2 building rooms (700 block)
        '701' => 'Math 2/700',
        '702' => 'Math 2/700',
        '703' => 'Math 2/700',
        '704' => 'Math 2/700',
        '705' => 'Math 2/700',
        '715' => 'Math 2/700', // Math
        '720' => 'Math 2/700', // Math
        '730' => 'Math 2/700', // Speech Language Pathologist
        '745' => 'Math 2/700', // Math
        '750' => 'Math 2/700', // Math/Algebra
        '755' => 'Math 2/700', // Math
        '760' => 'Math 2/700', // Math
        '775' => 'Math 2/700', // Math
        '780' => 'Math 2/700', // Math
        
        // Geo building rooms (800 block)
        '805' => 'Geo/800', // Social Science/Math/Athletic Director
        '810' => 'Geo/800', // Math
        '815' => 'Geo/800', // Math
        '820' => 'Geo/800', // Math
        '825' => 'Geo/800', // Social Science/GATE
        '830' => 'Geo/800', // Social Science
        '835' => 'Geo/800', // Geography
        '840' => 'Geo/800', // Social Science
        '845' => 'Geo/800', // Social Science
        '850' => 'Geo/800', // Social Science
        '855' => 'Geo/800', // Social Science
        '860' => 'Geo/800', // Social Science
        '865' => 'Geo/800', // Social Science
        
        // Social Sciences/Technology rooms (500 block)
        '510' => 'Geo/800', // Special Ed Mod/Sev
        '530' => 'Geo/800', // Social Science
        '535' => 'Geo/800', // Comp Tech
        '540' => 'Web Design', // Tech and Web Design
        '545' => 'Geo/800', // Social Science
        
        // Autoshop building rooms
        '143' => 'Autoshop',
        
        // Athletic Facilities
        // The New Gym building rooms
        '1300' => 'The New Gym/1300',
        
        // The Old Gym building rooms
        '1301' => 'The Old Gym',
        
        // The Locker Room
        'LR01' => 'The Locker Room/1000',
        
        // Dance
        '300' => 'Dance',
        
        // Campus Services
        // Theater
        '320' => 'Theater',
        
        // Cafeteria
        '401' => 'Cafeteria/400',
        
        // Portables
        'P1' => 'Portables', // Math/Guitar Band
        'P2' => 'Portables', // Science/Special Ed
        'P3' => 'Portables', // English
        'P4' => 'Portables', // EL/ELA Teacher
        'P101' => 'Portables',
        'P102' => 'Portables',
        'P103' => 'Portables',
        
        // Special Program Rooms
        '901' => 'Geo/800', // ROP Sports Med
        
        // Performing Arts
        '350' => 'Theater', // Choir
        '360' => 'Digital Arts',
        '370' => 'Black Box', // Drama
        '1310' => 'Band', // Music/Band/Guitar
        
        // Default to Math/Library if room can't be matched
        'default' => 'Math/Library/600'
    ];

        // Create the user schedule array for JavaScript
        for ($i = 1; $i <= 7; $i++) {
            $periodClass = $schedule["p{$i}c"] ?? '';
            $periodRoom = $schedule["p{$i}r"] ?? '';
            
            if (!empty($periodClass) && !empty($periodRoom)) {
                // Determine which building this room is in
                $building = $roomToBuilding[$periodRoom] ?? $roomToBuilding['default'];
                
                $userSchedule[] = [
                    'period' => $i,
                    'class' => $periodClass,
                    'room' => $periodRoom,
                    'building' => $building
                ];
            }
        }
    }
}

// Convert user schedule to JSON for JavaScript
$userScheduleJSON = json_encode($userSchedule);

include $_SERVER['DOCUMENT_ROOT'] . '/access/nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Navigator - Home</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    
    <!-- Your custom CSS -->
    <link href="style.css" rel="stylesheet">
    <style>
        #navigation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1001; /* Ensure it's above the map */
        }
        #map {
            width: 100vw;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }
        #sidebar {
            position: fixed;
            top: 80px; /* Adjust based on your navigation bar height */
            right: 0;
            width: 300px; /* Increased width for better button display */
            height: calc(100vh - 80px);
            background-color: rgba(255, 255, 255, 0.9);
            z-index: 1000;
            padding: 20px;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow-y: auto; /* Add scrolling for additional buttons */
        }
        #sidebar.collapsed {
            right: -270px; /* Adjusted for wider sidebar */
        }
        #sidebar .btn {
            width: 100%;
            margin-bottom: 10px;
            text-align: left;
            white-space: normal; /* Allow text to wrap */
        }
        #sidebar-toggle {
            position: absolute;
            left: 10px;
            top: 10px;
            cursor: pointer;
            font-size: 20px;
            background: none;
            border: none;
        }
        .location-group {
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }
        .category-button {
            width: 100%;
            text-align: left;
            font-weight: bold;
            margin-bottom: 10px;
            position: relative;
        }
        .category-button::after {
            content: "▼";
            position: absolute;
            right: 15px;
        }
        .category-button.collapsed::after {
            content: "►";
        }
        .location-list {
            padding-left: 10px;
        }
    </style>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
</head>
<body>
    <div id="navigation">
        <!-- Navigation is included above via PHP -->
    </div>
   
    <!-- Map -->
    <div id="map"></div>
    
    <!-- Sidebar -->
    <div id="sidebar">
        <button id="sidebar-toggle" type="button">≡</button>
        <h5 class="mb-3">Campus Locations</h5>
        
         <!-- My Classes Category -->
        <div class="location-group">
            <button class="btn btn-success category-button" type="button" id="myClassesBtn" style="background-color: #EEC643;" data-bs-toggle="collapse" data-bs-target="#myClasses" aria-expanded="false" aria-controls="myClasses">
                My Classes
            </button>
            <div class="collapse location-list" id="myClasses">
                <?php if (!isset($_SESSION['uid'])): ?>
                <div class="alert alert-info">
                    Please <a href="/user_pages/login.php">log in</a> to view your class schedule.
                </div>
                <?php elseif (empty($userSchedule)): ?>
                <div class="alert alert-info">
                    No classes found. <a href="/schedule.php">Add your schedule here</a>.
                </div>
                <?php endif; ?>
                <!-- Will be populated by JavaScript -->
                <div id="class-buttons-container"></div>
            </div>
        </div>
        
        <!-- Academic Buildings Category -->
        <div class="location-group">
            <button class="btn btn-primary category-button" type="button" data-bs-toggle="collapse" data-bs-target="#academicBuildings" aria-expanded="false" aria-controls="academicBuildings"  style="background-color: #0D21A1;">
                Academic Buildings
            </button>
            <div class="collapse location-list" id="academicBuildings">
                <button class="btn btn-outline-primary location-btn" data-lat="32.782500" data-lng="-116.986300">
                    English/1400
                </button>
                <button class="btn btn-outline-primary location-btn" data-lat="32.781111" data-lng="-116.987944">
                    Art/Office/200
                </button>
                <button class="btn btn-outline-primary location-btn" data-lat="32.781750" data-lng="-116.987222">
                    Bio/Science/1100
                </button>
                <button class="btn btn-outline-primary location-btn" data-lat="32.781139" data-lng="-116.986444">
                    Math/Library/600
                </button>
                <button class="btn btn-outline-primary location-btn" data-lat="32.781556" data-lng="-116.986639">
                    Math 2/700
                </button>
                <button class="btn btn-outline-primary location-btn" data-lat="32.781480" data-lng="-116.985197">
                    Geo/800
                </button>
                <button class="btn btn-outline-primary location-btn" data-lat="32.782639" data-lng="-116.986667">
                    Autoshop
                </button>
				<button class="btn btn-outline-primary location-btn" data-lat="32.781138" data-lng="-116.986443">
                    Web Design
                </button>
				<button class="btn btn-outline-primary location-btn" data-lat="32.782829630723114" data-lng="-116.98712183732681">
                    Band
                </button>
					<button class="btn btn-outline-primary location-btn" data-lat="32.78086969510307" data-lng="-116.98742442765177">
                    Digital Arts
                </button>
				<button class="btn btn-outline-primary location-btn" data-lat="32.78082279412269" data-lng="-116.987249630877">
                    Black Box
                </button>
            </div>
        </div>

        <!-- Athletic Facilities Category -->
        <div class="location-group">
            <button class="btn btn-success category-button" type="button" data-bs-toggle="collapse" data-bs-target="#athleticFacilities" aria-expanded="false" aria-controls="athleticFacilities" style="background-color: #EEC643;">
                Athletic Facilities
            </button>
            <div class="collapse location-list" id="athleticFacilities">
                <button class="btn btn-outline-success location-btn" data-lat="32.781611" data-lng="-116.988083">
                    Field
                </button>
                <button class="btn btn-outline-success location-btn" data-lat="32.782142" data-lng="-116.987583">
                    The New Gym/1300
                </button>
                <button class="btn btn-outline-success location-btn" data-lat="32.781222" data-lng="-116.987083">
                    The Old Gym
                </button>
                <button class="btn btn-outline-success location-btn" data-lat="32.782333" data-lng="-116.987667">
                    Pool
                </button>
                <button class="btn btn-outline-success location-btn" data-lat="32.780806" data-lng="-116.987139">
                    The Locker Room/1000
                </button>
                <button class="btn btn-outline-success location-btn" data-lat="32.780667" data-lng="-116.987639">
                    Dance
                </button>
            </div>
        </div>

        <!-- Campus Services Category -->
        <div class="location-group">
            <button class="btn btn-info category-button" type="button" data-bs-toggle="collapse" data-bs-target="#campusServices" aria-expanded="false" aria-controls="campusServices" style="background-color: #0D21A1; color: white;">
                Campus Services
            </button>
            <div class="collapse location-list" id="campusServices">
                <button class="btn btn-outline-primary location-btn" data-lat="32.780806" data-lng="-116.987139">
                    District Office
                </button>
                <button class="btn btn-outline-primary location-btn" data-lat="32.780806" data-lng="-116.987139">
                    Daycare/900
                </button>
                <button class="btn btn-outline-primary location-btn" data-lat="32.780500" data-lng="-116.987250">
                    Theater
                </button>
                <button class="btn btn-outline-primary location-btn" data-lat="32.781556" data-lng="-116.987417">
                    Cafeteria/400
                </button>
                <button class="btn btn-outline-primary location-btn" data-lat="32.782889" data-lng="-116.986750">
                    Portables
                </button>
            </div>
        </div>
        
        <!-- Location dropdown -->
        <div class="mt-4">
            <label for="location-select" class="form-label">Find Location:</label>
            <select id="location-select" class="form-select">
                <option value="">Select a location...</option>
            </select>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Get user schedule from PHP
    const userSchedule = <?php echo $userScheduleJSON ?: '[]'; ?>;
    
    document.addEventListener('DOMContentLoaded', function () {
        try {
            // Define map bounds
            const southWest = [32.779472, -116.990944];
            const northEast = [32.784626, -116.984463];
            const map = L.map('map', {
                maxBounds: [southWest, northEast],
                maxZoom: 19,
                minZoom: 17,
                maxBoundsViscosity: 1.0
            }).setView([32.7814, -116.9929], 18);

            // Add tile layer
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                bounds: [southWest, northEast],
                noWrap: true
            }).addTo(map);

            // Create location markers
            const locationMarkers = [
                { name: "English/1400", lat: 32.782500, lng: -116.986300, type: "academic" },
                { name: "Art/Office/200", lat: 32.781111, lng: -116.987944, type: "academic" },
                { name: "Bio/Science/1100", lat: 32.781750, lng: -116.987222, type: "academic" },
                { name: "Field", lat: 32.781611, lng: -116.988083, type: "athletic" },
                { name: "Math/Library/600", lat: 32.781139, lng: -116.986444, type: "academic" },
                { name: "Portables", lat: 32.782889, lng: -116.986750, type: "service" },
                { name: "District Office", lat: 32.780806, lng: -116.987139, type: "service" },
                { name: "The Locker Room/1000", lat: 32.782333, lng: -116.987667, type: "athletic" },
                { name: "Pool", lat: 32.782139, lng: -116.987000, type: "athletic" },
                { name: "Daycare/900", lat: 32.781472, lng: -116.984750, type: "service" },
                { name: "Geo/800", lat: 32.781480, lng: -116.985197, type: "academic" },
                { name: "Math 2/700", lat: 32.781556, lng: -116.986639, type: "academic" },
                { name: "Autoshop", lat: 32.783072, lng: -116.986426, type: "academic" },
                { name: "The New Gym/1300", lat: 32.782417, lng: -116.987028, type: "athletic" },
                { name: "The Old Gym", lat: 32.781222, lng: -116.987083, type: "athletic" },
                { name: "Dance", lat: 32.780667, lng: -116.987833, type: "athletic" },
                { name: "Theater", lat: 32.780500, lng: -116.987250, type: "service" },
                { name: "Cafeteria/400", lat: 32.781556, lng: -116.987417, type: "service" },
				{ name: "Web Design", lat: 32.781138, lng: -116.986443 , type: "academic" },
				{ name: "Band", lat: 32.782829630723114, lng: -116.98712183732681, type: "academic" },
				{ name: "Digital Arts", lat: 32.78086969510307, lng: -116.98742442765177, type: "academic" },
				{ name: "Black Box", lat: 32.78082279412269, lng: -116.987249630877, type: "academic" }
            ];

            // Create map markers
            const markers = {};
            const academicMarkers = [];
            const athleticMarkers = [];
            const serviceMarkers = [];
            
            // Track current points and path
            let startPoint = null;
            let endPoint = null;
            let pathLine = null;
            
            // Track displayed markers
            let displayedMarkers = [];
            
            // Define custom marker icons for start and end points
            const startIcon = L.icon({
                iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            
            const endIcon = L.icon({
                iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            // Create markers for all locations and add to appropriate arrays
            locationMarkers.forEach(location => {
                // Create marker but DO NOT add to the map initially
                const marker = L.marker([location.lat, location.lng])
                    .bindPopup(`<strong>${location.name}</strong>`);
                
                // Store marker for later reference
                markers[location.name] = marker;
                
                // Add to type-specific arrays
                if (location.type === "academic") {
                    academicMarkers.push(marker);
                } else if (location.type === "athletic") {
                    athleticMarkers.push(marker);
                } else if (location.type === "service") {
                    serviceMarkers.push(marker);
                }
                
                // Add to dropdown
                const option = document.createElement('option');
                option.value = location.name;
                option.textContent = location.name;
                document.getElementById('location-select').appendChild(option);
            });

            // Add navigation UI to sidebar
            const sidebarHeader = document.querySelector('#sidebar h5');
            const navigationDiv = document.createElement('div');
            navigationDiv.className = 'location-group mt-4';
            navigationDiv.innerHTML = `
                <h6>Navigation</h6>
                <div class="mb-2">
                    <button id="set-start" class="btn btn-success mb-2">Set as Start</button>
                    <button id="set-end" class="btn btn-danger mb-2">Set as End</button>
                    <button id="clear-route" class="btn btn-secondary">Clear Route</button>
                </div>
                <div id="selected-location" class="alert alert-info" style="display:none;">
                    <strong>Selected:</strong> <span id="location-name"></span>
                </div>
            `;
            sidebarHeader.parentNode.insertBefore(navigationDiv, sidebarHeader.nextSibling);
            
            // Variable to track the currently selected location
            let selectedLocation = null;
            
            // Function to update selected location info
            function updateSelectedLocation(location) {
                selectedLocation = location;
                const locationNameElement = document.getElementById('location-name');
                const selectedLocationDiv = document.getElementById('selected-location');
                
                if (location) {
                    locationNameElement.textContent = location.name;
                    selectedLocationDiv.style.display = 'block';
                } else {
                    selectedLocationDiv.style.display = 'none';
                }
            }

            // Function to draw or update the path between points
            function updatePath() {
                // Remove existing path if it exists
                if (pathLine && map.hasLayer(pathLine)) {
                    map.removeLayer(pathLine);
                }
                
                // Draw new path if both points exist
                if (startPoint && endPoint) {
                    const pointA = [startPoint.lat, startPoint.lng];
                    const pointB = [endPoint.lat, endPoint.lng];
                    
                    // Create a new polyline
                    pathLine = L.polyline([pointA, pointB], {
                        color: 'blue',
                        weight: 5,
                        opacity: 0.7,
                        dashArray: '10, 10',
                        lineJoin: 'round'
                    }).addTo(map);
                    
                    // Fit map to show the entire path
                    map.fitBounds(pathLine.getBounds(), {
                        padding: [50, 50]
                    });
                }
            }
            
            // Function to set or update the start point
            function setStartPoint(location) {
                // Remove existing start marker if it exists
                if (startPoint && startPoint.marker && map.hasLayer(startPoint.marker)) {
                    map.removeLayer(startPoint.marker);
                }
                
                // Create new start marker
                const marker = L.marker([location.lat, location.lng], {icon: startIcon})
                    .bindPopup(`<strong>Start: ${location.name}</strong>`)
                    .addTo(map)
                    .openPopup();
                    
                // Update start point
                startPoint = {
                    name: location.name,
                    lat: location.lat,
                    lng: location.lng,
                    marker: marker
                };
                
                // Update path if end point also exists
                if (endPoint) {
                    updatePath();
                }
            }
            
            // Function to set or update the end point
            function setEndPoint(location) {
                // Remove existing end marker if it exists
                if (endPoint && endPoint.marker && map.hasLayer(endPoint.marker)) {
                    map.removeLayer(endPoint.marker);
                }
                
                // Create new end marker
                const marker = L.marker([location.lat, location.lng], {icon: endIcon})
                    .bindPopup(`<strong>End: ${location.name}</strong>`)
                    .addTo(map)
                    .openPopup();
                    
                // Update end point
                endPoint = {
                    name: location.name,
                    lat: location.lat,
                    lng: location.lng,
                    marker: marker
                };
                
                // Update path if start point also exists
                if (startPoint) {
                    updatePath();
                }
            }
            
            // Function to clear all displayed regular markers
            function clearDisplayedMarkers() {
                displayedMarkers.forEach(marker => {
                    if (map.hasLayer(marker)) {
                        map.removeLayer(marker);
                    }
                });
                displayedMarkers = [];
            }
            
            // Function to handle location button clicks - MODIFIED to improve location finding
            function handleLocationClick(locationName) {
                console.log("Handling click for:", locationName);
                
                // Clear all previously displayed markers first
                clearDisplayedMarkers();
                
                // Try to find an exact match first
                let location = locationMarkers.find(loc => loc.name === locationName);
                
                // If no exact match, try to find a partial match
                if (!location) {
                    // For buildings with numbers, try matching just the name part
                    const buildingName = locationName.split('/')[0].trim();
                    console.log("Trying to match building name:", buildingName);
                    
                    location = locationMarkers.find(loc => 
                        loc.name.includes(buildingName) || 
                        buildingName.includes(loc.name.split('/')[0].trim())
                    );
                }
                
                if (location) {
                    console.log("Found location:", location);
                    // Pan to location
                    map.setView([location.lat, location.lng], 19);
                    
                    // Update selected location
                    updateSelectedLocation(location);
                    
                    // Show the marker
                    const marker = markers[location.name];
                    if (marker) {
                        marker.addTo(map).openPopup();
                        displayedMarkers.push(marker); // Track this marker
                    }
                } else {
                    console.warn(`Location not found: ${locationName}`);
                }
            }

            // Event listeners for the navigation buttons
            document.getElementById('set-start').addEventListener('click', function() {
                if (selectedLocation) {
                    setStartPoint(selectedLocation);
                } else {
                    alert('Please select a location first');
                }
            });
            
            document.getElementById('set-end').addEventListener('click', function() {
                if (selectedLocation) {
                    setEndPoint(selectedLocation);
                } else {
                    alert('Please select a location first');
                }
            });
            
            document.getElementById('clear-route').addEventListener('click', function() {
                // Remove start marker
                if (startPoint && startPoint.marker && map.hasLayer(startPoint.marker)) {
                    map.removeLayer(startPoint.marker);
                }
                
                // Remove end marker
                if (endPoint && endPoint.marker && map.hasLayer(endPoint.marker)) {
                    map.removeLayer(endPoint.marker);
                }
                
                // Remove path
                if (pathLine && map.hasLayer(pathLine)) {
                    map.removeLayer(pathLine);
                }
                
                // Remove all regular markers too
                clearDisplayedMarkers();
                
                // Reset variables
                startPoint = null;
                endPoint = null;
                pathLine = null;
                selectedLocation = null;
                
                // Hide selected location info
                document.getElementById('selected-location').style.display = 'none';
            });

            // Toggle sidebar
            document.getElementById('sidebar-toggle').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('collapsed');
            });

            // Category buttons functionality
            document.querySelectorAll('.category-button').forEach(button => {
                button.addEventListener('click', function() {
                    this.classList.toggle('collapsed');
                });
            });

            // Location buttons event listeners - adding event delegation
            document.addEventListener('click', function(event) {
                // Check if clicked element is a location button
                if (event.target.classList.contains('location-btn')) {
                    const locationName = event.target.textContent.trim();
                    handleLocationClick(locationName);
                }
                
                // Check if clicked element is a class button
                if (event.target.classList.contains('class-btn')) {
                    const buildingName = event.target.getAttribute('data-building');
                    if (buildingName) {
                        handleLocationClick(buildingName);
                    }
                }
            });

            // Add user's class buttons to the "My Classes" section - Completely revised approach
            const classButtonsContainer = document.getElementById('class-buttons-container');
            if (userSchedule && userSchedule.length > 0 && classButtonsContainer) {
                // Clear any existing buttons
                classButtonsContainer.innerHTML = '';
                
                // Create buttons for each class
                userSchedule.forEach(item => {
                    const button = document.createElement('button');
                    button.className = 'btn btn-outline-warning class-btn';
                    button.setAttribute('data-building', item.building);
                    button.innerHTML = `Period ${item.period}: ${item.class} (Room ${item.room})`;
                    classButtonsContainer.appendChild(button);
                    
                    // Direct event listener for each button to ensure it works
                    button.onclick = function() {
                        console.log("Class button clicked for building:", item.building);
                        handleLocationClick(item.building);
                    };
                });
                
                // Log for debugging
                console.log(`Added ${userSchedule.length} class buttons`);
            }

            // Location dropdown event listener
            document.getElementById('location-select').addEventListener('change', function() {
                const selectedName = this.value;
                
                if (!selectedName) return; // Do nothing if default option is selected
                
                handleLocationClick(selectedName);
                
                // Reset dropdown to default option after action
                this.value = "";
            });

            // Original fetch locations code (for buildings, classrooms, etc.)
            fetch('fetch_locations.php')
                .then(response => response.json())
                .then(data => {
                    // Process building polygons
                    data.forEach(location => {
                        if (location.type === "Building" && location.boundary) {
                            // Add polygons for buildings
                            const polygon = L.polygon(location.boundary, {
                                color: 'blue',
                                fillColor: 'lightblue',
                                fillOpacity: 0.5
                            }).addTo(map);

                            // Add popup for the polygon
                            polygon.bindPopup(`<strong>${location.name}</strong><br>${location.type}`);

                            // Add hover effects
                            polygon.on('mouseover', function () {
                                this.setStyle({ color: 'red', fillColor: 'pink' });
                            });
                            polygon.on('mouseout', function () {
                                this.setStyle({ color: 'blue', fillColor: 'lightblue' });
                            });
                        }
                    });
                })
                .catch(error => console.error('Error fetching locations:', error));

            console.log('Map initialized successfully with navigation features');
        } catch (error) {
            console.error('Error initializing map:', error);
        }
    });
    </script>
</body>
</html>