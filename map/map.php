<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Campus Navigator - Home</title>
    
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
        <?php
        session_start();
        include $_SERVER['DOCUMENT_ROOT'] . '/access/nav.php';
        ?>
    </div>
   
    <!-- Map -->
    <div id="map"></div>
    
    <!-- Sidebar -->
    <div id="sidebar">
        <button id="sidebar-toggle" type="button">≡</button>

        <h5 class="mb-3"> Campus Locations </h5>
        
<<<<<<< HEAD
        <!-- My Classes Category -->
        <div class="location-group">
            <button class="btn btn-success category-button" type="button" data-bs-toggle="collapse" data-bs-target="#myClasses" aria-expanded="false" aria-controls="myClasses" style="background-color: #EEC643;">
               My Classes
            </button>
            <div class="collapse location-list" id="myClasses">
                <!-- Class buttons will be added here by JavaScript -->
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
=======
		 <!-- My Classes Category -->
	<div class="location-group">
    <button class="btn btn-success category-button" type="button" data-bs-toggle="collapse" data-bs-target="#myClasses" aria-expanded="false" aria-controls="myClasses" style="background-color: #EEC643;">
       My Classes
    </button>
</div>
		
       <!-- Academic Buildings Category -->
<div class="location-group">
    <button class="btn btn-primary category-button" type="button" data-bs-toggle="collapse" data-bs-target="#academicBuildings" aria-expanded="false" aria-controls="academicBuildings"  style="background-color: #0D21A1;">

        <h5 class="mb-3">Campus Locations</h5>
        
       <!-- Academic Buildings Category -->
<div class="location-group">
    <button class="btn btn-primary category-button" type="button" data-bs-toggle="collapse" data-bs-target="#academicBuildings" aria-expanded="false" aria-controls="academicBuildings">

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
    </div>
</div>

<!-- Athletic Facilities Category -->
<div class="location-group">

    <button class="btn btn-success category-button" type="button" data-bs-toggle="collapse" data-bs-target="#athleticFacilities" aria-expanded="false" aria-controls="athleticFacilities" style="background-color: #EEC643;">

    <button class="btn btn-success category-button" type="button" data-bs-toggle="collapse" data-bs-target="#athleticFacilities" aria-expanded="false" aria-controls="athleticFacilities">

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

    <button class="btn btn-info category-button" type="button" data-bs-toggle="collapse" data-bs-target="#campusServices" aria-expanded="false" aria-controls="campusServices">
        Campus Services
    </button>

    <div class="collapse location-list" id="campusServices">
        <button class="btn btn-outline-info location-btn" data-lat="32.780806" data-lng="-116.987139">
            District Office
        </button>
        <button class="btn btn-outline-info location-btn" data-lat="32.780806" data-lng="-116.987139">
            Daycare/900
        </button>
        <button class="btn btn-outline-info location-btn" data-lat="32.780500" data-lng="-116.987250">
            Theater
        </button>
        <button class="btn btn-outline-info location-btn" data-lat="32.781556" data-lng="-116.987417">
            Cafeteria/400
        </button>
        <button class="btn btn-outline-info location-btn" data-lat="32.782889" data-lng="-116.986750">
            Portables
        </button>
    </div>
</div>
>>>>>>> 1d1cf00922124fd02eb0978afc3f7d2bc96e362e

        <!-- Campus Services Category -->
        <div class="location-group">
            <button class="btn btn-info category-button" type="button" data-bs-toggle="collapse" data-bs-target="#campusServices" aria-expanded="false" aria-controls="campusServices" style="background-color: #0D21A1; color: white;">
                Campus Services
            </button>
            <div class="collapse location-list" id="campusServices">
                <button class="btn btn-outline-info location-btn" data-lat="32.780806" data-lng="-116.987139">
                    District Office
                </button>
                <button class="btn btn-outline-info location-btn" data-lat="32.780806" data-lng="-116.987139">
                    Daycare/900
                </button>
                <button class="btn btn-outline-info location-btn" data-lat="32.780500" data-lng="-116.987250">
                    Theater
                </button>
                <button class="btn btn-outline-info location-btn" data-lat="32.781556" data-lng="-116.987417">
                    Cafeteria/400
                </button>
                <button class="btn btn-outline-info location-btn" data-lat="32.782889" data-lng="-116.986750">
                    Portables
                </button>
            </div>
        </div>
        
        <!-- Academic Buildings Category -->
        <div class="location-group">
            <button class="btn btn-primary category-button" type="button" data-bs-toggle="collapse" data-bs-target="#academicBuildings" aria-expanded="true" aria-controls="academicBuildings">
                Academic Buildings
            </button>
            <div class="collapse show location-list" id="academicBuildings">
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
            </div>
        </div>
        
        <!-- Athletic Facilities Category -->
        <div class="location-group">
            <button class="btn btn-success category-button" type="button" data-bs-toggle="collapse" data-bs-target="#athleticFacilities" aria-expanded="true" aria-controls="athleticFacilities">
                Athletic Facilities
            </button>
            <div class="collapse show location-list" id="athleticFacilities">
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
            <button class="btn btn-info category-button" type="button" data-bs-toggle="collapse" data-bs-target="#campusServices" aria-expanded="true" aria-controls="campusServices">
                Campus Services
            </button>
            <div class="collapse show location-list" id="campusServices">
                <button class="btn btn-outline-info location-btn" data-lat="32.780806" data-lng=" -116.987139">
				District Office</button>
                <button class="btn btn-outline-info location-btn" data-lat="32.780806" data-lng="-116.987139">
                    Daycare/900
                </button>
                <button class="btn btn-outline-info location-btn" data-lat="32.780500" data-lng="-116.987250">
                    Theater
                </button>
                <button class="btn btn-outline-info location-btn" data-lat="32.781556" data-lng="-116.987417">
                    Cafeteria/400
                </button>
                <button class="btn btn-outline-info location-btn" data-lat="32.782889" data-lng="-116.986750">
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
            
            <!-- Connection Mode Button -->
            <button id="connection-mode" class="btn btn-danger mt-3">Connect Two Locations</button>
            
            <!-- Clear Line Button -->
            <button id="clear-line" class="btn btn-secondary mt-2">Clear Line</button>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    
    <script>
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
                { name: "Cafeteria/400", lat: 32.781556, lng: -116.987417, type: "service" }

				{ name: "Art/Office/200", lat: 32.781111, lng: -116.987944, type: "academic" },
				{ name: "Bio/Science/1100", lat: 32.781750, lng: -116.987222, type: "academic" },
				{ name: "Field", lat: 32.781611, lng: -116.988083, type: "athletic" },
				{ name: "Math/Library/600", lat: 32.781139, lng: -116.986444, type: "academic" },
				{ name: "Portables", lat: 32.782889, lng: -116.986750, type: "service" },
				{ name: "District Office", lat: 32.780806, lng: -116.987139, type: "service" },
				{ name: "The Locker Room/1000", lat: 32.782333, lng: -116.987667, type: "athletic" },
				{ name: "Pool", lat: 32.782139, lng: -116.987000, type: "athletic" },
				{ name: "Daycare/900", lat: 32.781472, lng: -116.984750, type: "service" },
				{ name: "Geo/800", lat: 32.781480, lng: -116.985197, type: "academic" }, // Converted from 32°46'54.1"N 116°59'08.7"W
				{ name: "Math 2/700", lat: 32.781556, lng: -116.986639, type: "academic" },
				{ name: "Autoshop", lat: 32.783072, lng: -116.986426, type: "academic" },
				{ name: "The New Gym/1300", lat: 32.782417, lng: -116.987028, type: "athletic" },
				{ name: "The Old Gym", lat: 32.781222, lng: -116.987083, type: "athletic" },
				{ name: "Dance", lat: 32.780667, lng: -116.987833, type: "athletic" },
				{ name: "Theater", lat: 32.780500, lng: -116.987250, type: "service" },
				{ name: "Cafeteria/400", lat: 32.781556, lng: -116.987417, type: "service" }


            ];

            // Create map markers
            const markers = {};
            const academicMarkers = [];
            const athleticMarkers = [];
            const serviceMarkers = [];

            
            // Track the currently visible marker
            let currentMarker = null;
            
            // Variables for connection mode
            let connectionMode = {
                active: false,
                firstPoint: null
            };
            
            // Variable to store the route line
            let routeLine = null;

            // Create markers for all locations and add to appropriate arrays
            locationMarkers.forEach(location => {
                // Create marker but DO NOT add to the map initially



            // Create markers for all locations and add to appropriate arrays
            locationMarkers.forEach(location => {
                // Add marker to the map

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


            // Function to remove current marker and display a new one
            function showMarker(markerName) {
                // Remove current marker if there is one
                if (currentMarker && map.hasLayer(markers[currentMarker])) {
                    map.removeLayer(markers[currentMarker]);
                }
                
                // Update current marker
                currentMarker = markerName;
                
                // Add new marker to map
                markers[markerName].addTo(map);
                
                // Open popup
                markers[markerName].openPopup();
            }
            
            // Function to draw a line between two points
            function drawLineBetweenPoints(point1, point2) {
                // Remove any existing route line if there is one
                if (routeLine && map.hasLayer(routeLine)) {
                    map.removeLayer(routeLine);
                }
                
                // Create a polyline with the two points
                routeLine = L.polyline([
                    [point1.lat, point1.lng],
                    [point2.lat, point2.lng]
                ], {
                    color: 'red',
                    weight: 4,
                    opacity: 0.7,
                    dashArray: '10, 10', // Creates a dashed line
                    lineJoin: 'round'
                }).addTo(map);
                
                // Fit the map to show the complete line
                map.fitBounds(routeLine.getBounds(), {
                    padding: [50, 50] // Add some padding around the line
                });
            }
            
            // Clear line button functionality
            document.getElementById('clear-line').addEventListener('click', function() {
                if (routeLine && map.hasLayer(routeLine)) {
                    map.removeLayer(routeLine);
                }
            });



            // Add all markers to map initially
            const allMarkers = [...academicMarkers, ...athleticMarkers, ...serviceMarkers];
            allMarkers.forEach(marker => marker.addTo(map));


            // Toggle sidebar
            document.getElementById('sidebar-toggle').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('collapsed');
            });
            
            // Connection mode button functionality
            document.getElementById('connection-mode').addEventListener('click', function() {
                connectionMode.active = !connectionMode.active;
                connectionMode.firstPoint = null;
                
                if (connectionMode.active) {
                    this.textContent = 'Cancel Connection';
                    this.classList.add('active');
                    alert('Select the first location to connect');
                } else {
                    this.textContent = 'Connect Two Locations';
                    this.classList.remove('active');
                }
            });

            // Category buttons functionality
            document.querySelectorAll('.category-button').forEach(button => {
                button.addEventListener('click', function() {
                    this.classList.toggle('collapsed');

                    // This now just expands/collapses the location list


                    // This now just expands/collapses the location list

                    
                    // Toggle visibility of respective marker types when category is clicked
                    const categoryType = this.textContent.trim();
                    
                    if (categoryType === "Academic Buildings") {
                        if (this.classList.contains('collapsed')) {
                            // Remove academic markers if collapsed
                            academicMarkers.forEach(marker => map.removeLayer(marker));
                        } else {
                            // Add academic markers if expanded
                            academicMarkers.forEach(marker => {
                                if (!map.hasLayer(marker)) {
                                    marker.addTo(map);
                                }
                            });
                        }
                    } else if (categoryType === "Athletic Facilities") {
                        if (this.classList.contains('collapsed')) {
                            // Remove athletic markers if collapsed
                            athleticMarkers.forEach(marker => map.removeLayer(marker));
                        } else {
                            // Add athletic markers if expanded
                            athleticMarkers.forEach(marker => {
                                if (!map.hasLayer(marker)) {
                                    marker.addTo(map);
                                }
                            });
                        }
                    } else if (categoryType === "Campus Services") {
                        if (this.classList.contains('collapsed')) {
                            // Remove service markers if collapsed
                            serviceMarkers.forEach(marker => map.removeLayer(marker));
                        } else {
                            // Add service markers if expanded
                            serviceMarkers.forEach(marker => {
                                if (!map.hasLayer(marker)) {
                                    marker.addTo(map);
                                }
                            });
                        }
                    }


                });
            });

            // Location buttons event listeners
            document.querySelectorAll('.location-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const lat = parseFloat(this.getAttribute('data-lat'));
                    const lng = parseFloat(this.getAttribute('data-lng'));
                    const locationName = this.textContent.trim();
                    
<<<<<<< HEAD
                    // Check if we're in connection mode
                    if (connectionMode.active) {
                        if (!connectionMode.firstPoint) {
                            // This is the first point
                            connectionMode.firstPoint = { lat, lng, name: locationName };
                            alert(`Selected "${locationName}" as first point. Now select the second point to connect.`);
                        } else {
                            // This is the second point, draw the line
                            drawLineBetweenPoints(
                                connectionMode.firstPoint,
                                { lat, lng, name: locationName }
                            );
                            
                            // Show both markers
                            if (map.hasLayer(markers[connectionMode.firstPoint.name])) {
                                map.removeLayer(markers[connectionMode.firstPoint.name]);
                            }
                            if (map.hasLayer(markers[locationName])) {
                                map.removeLayer(markers[locationName]);
                            }
                            
                            markers[connectionMode.firstPoint.name].addTo(map);
                            markers[locationName].addTo(map).openPopup();
                            
                            // Reset connection mode
                            connectionMode.active = false;
                            connectionMode.firstPoint = null;
                            document.getElementById('connection-mode').textContent = 'Connect Two Locations';
                            document.getElementById('connection-mode').classList.remove('active');
                        }
                    } else {
                        // Regular behavior - pan to location
                        map.setView([lat, lng], 19);
                        showMarker(locationName);
                    }
=======
                    // Pan to location
                    map.setView([lat, lng], 19);
                    
                    // Show the marker
                    showMarker(locationName);


                    // Find corresponding marker
                    const marker = markers[locationName];
                    
                    if (marker) {
                        // Ensure marker is on map
                        if (!map.hasLayer(marker)) {
                            marker.addTo(map);
                        }
                        
                        // Pan to location
                        map.setView([lat, lng], 19);
                        
                        // Open popup
                        marker.openPopup();
                    } else {
                        // If no marker exists, just pan to the location
                        map.setView([lat, lng], 19);
                    }


>>>>>>> 1d1cf00922124fd02eb0978afc3f7d2bc96e362e
                });
            });

            // Location dropdown event listener
            document.getElementById('location-select').addEventListener('change', function() {
                const selectedName = this.value;
                
                if (!selectedName) return; // Do nothing if default option is selected
                
                const locationInfo = locationMarkers.find(loc => loc.name === selectedName);
                
                if (locationInfo) {
                    // Check if we're in connection mode
                    if (connectionMode.active) {
                        if (!connectionMode.firstPoint) {
                            // This is the first point
                            connectionMode.firstPoint = { 
                                lat: locationInfo.lat, 
                                lng: locationInfo.lng, 
                                name: selectedName 
                            };
                            alert(`Selected "${selectedName}" as first point. Now select the second point to connect.`);
                        } else {
                            // This is the second point, draw the line
                            drawLineBetweenPoints(
                                connectionMode.firstPoint,
                                { lat: locationInfo.lat, lng: locationInfo.lng, name: selectedName }
                            );
                            
                            // Show both markers
                            if (map.hasLayer(markers[connectionMode.firstPoint.name])) {
                                map.removeLayer(markers[connectionMode.firstPoint.name]);
                            }
                            if (map.hasLayer(markers[selectedName])) {
                                map.removeLayer(markers[selectedName]);
                            }
                            
                            markers[connectionMode.firstPoint.name].addTo(map);
                            markers[selectedName].addTo(map).openPopup();
                            
                            // Reset connection mode
                            connectionMode.active = false;
                            connectionMode.firstPoint = null;
                            document.getElementById('connection-mode').textContent = 'Connect Two Locations';
                            document.getElementById('connection-mode').classList.remove('active');
                        }
                    } else {
                        // Regular behavior
                        map.setView([locationInfo.lat, locationInfo.lng], 19);
                        showMarker(selectedName);
                    }
                    
                    // Reset dropdown to default option after action
                    this.value = "";

    
              const locationInfo = locationMarkers.find(loc => loc.name === selectedName);
                
                if (locationInfo) {
                    // Ensure marker is on map
                    const marker = markers[selectedName];
                    if (marker && !map.hasLayer(marker)) {
                        marker.addTo(map);
                    }
                    
                    // Pan to location
                    map.setView([locationInfo.lat, locationInfo.lng], 19);
                    
                    // Open popup if marker exists
                    if (marker) {
                        marker.openPopup();
                    }


                }
            });

            // Class data from the profile page
            const classSchedule = [
                { period: 1, class: "English", room: "100", building: "English/1400" },
                { period: 2, class: "Math", room: "200", building: "Art/Office/200" },
                { period: 3, class: "Dance", room: "300", building: "Dance" },
                { period: 4, class: "Theater", room: "400", building: "Theater" },
                { period: 5, class: "Autoshop", room: "500", building: "Autoshop" },
                { period: 6, class: "Bio", room: "600", building: "Bio/Science/1100" },
                { period: 7, class: "Geo", room: "700", building: "Geo/800" }
            ];
            
            // Find the My Classes div
            const myClassesDiv = document.querySelector('#myClasses');
            
            // Add class buttons with "Path to Next Class" feature
            classSchedule.forEach((item, index) => {
                const buildingInfo = locationMarkers.find(loc => loc.name === item.building);
                
                if (buildingInfo) {
                    // Create container for the button group
                    const buttonContainer = document.createElement('div');
                    buttonContainer.className = 'd-flex flex-column mb-2';
                    
                    // Create the main class button
                    const button = document.createElement('button');
                    button.className = 'btn btn-outline-warning location-btn';
                    button.setAttribute('data-lat', buildingInfo.lat);
                    button.setAttribute('data-lng', buildingInfo.lng);
                    button.textContent = `Period ${item.period}: ${item.class} (Room ${item.room})`;
                    
                    button.addEventListener('click', function() {
                        if (!connectionMode.active) {
                            map.setView([buildingInfo.lat, buildingInfo.lng], 19);
                            showMarker(item.building);
                        } else {
                            // Handle connection mode click
                            if (!connectionMode.firstPoint) {
                                connectionMode.firstPoint = { 
                                    lat: buildingInfo.lat, 
                                    lng: buildingInfo.lng, 
                                    name: item.building 
                                };
                                alert(`Selected "${item.building}" as first point. Now select the second point to connect.`);
                            } else {
                                drawLineBetweenPoints(
                                    connectionMode.firstPoint,
                                    { lat: buildingInfo.lat, lng: buildingInfo.lng, name: item.building }
                                );
                                
                                // Show both markers
                                if (map.hasLayer(markers[connectionMode.firstPoint.name])) {
                                    map.removeLayer(markers[connectionMode.firstPoint.name]);
                                }
                                if (map.hasLayer(markers[item.building])) {
                                    map.removeLayer(markers[item.building]);
                                }
                                
                                markers[connectionMode.firstPoint.name].addTo(map);
                                markers[item.building].addTo(map).openPopup();
                                
                                // Reset connection mode
                                connectionMode.active = false;
                                connectionMode.firstPoint = null;
                                document.getElementById('connection-mode').textContent = 'Connect Two Locations';
                                document.getElementById('connection-mode').classList.remove('active');
                            }
                        }
                    });
                    
                    buttonContainer.appendChild(button);
                    
                    // If there's a next class, add a "show path" button
                    if (index < classSchedule.length - 1) {
                        const nextClass = classSchedule[index + 1];
                        const nextBuildingInfo = locationMarkers.find(loc => loc.name === nextClass.building);
                        
                        if (nextBuildingInfo) {
                            const pathButton = document.createElement('button');
                            pathButton.className = 'btn btn-sm btn-outline-danger mt-1 mb-2';
                            pathButton.innerHTML = `→ Show path to Period ${nextClass.period}`;
                            pathButton.title = `Show path to Period ${nextClass.period}: ${nextClass.class}`;
                            
                            pathButton.addEventListener('click', function(e) {
                                e.stopPropagation(); // Prevent triggering the parent button
                                
                                // Draw line between current and next class
                                drawLineBetweenPoints(
                                    { lat: buildingInfo.lat, lng: buildingInfo.lng, name: item.building },
                                    { lat: nextBuildingInfo.lat, lng: nextBuildingInfo.lng, name: nextClass.building }
                                );
                                
                                // Show both markers
                                if (map.hasLayer(markers[item.building])) {
                                    map.removeLayer(markers[item.building]);
                                }
                                if (map.hasLayer(markers[nextClass.building])) {
                                    map.removeLayer(markers[nextClass.building]);
                                }
                                
                                markers[item.building].addTo(map);
                                markers[nextClass.building].addTo(map).openPopup();
                            });
                            
                            buttonContainer.appendChild(pathButton);
                        }
                    }
                    
                    myClassesDiv.appendChild(buttonContainer);
                }
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


            console.log('Map initialized successfully with pins hidden until clicked');


            console.log('Map initialized successfully with pins hidden until clicked');

            console.log('Map initialized successfully with all campus locations');


        } catch (error) {
            console.error('Error initializing map:', error);
        }
    });
</script>
</body>
</html>