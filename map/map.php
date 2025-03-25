

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
        
		 <!-- My Classes Category -->
	<div class="location-group">
    <button class="btn btn-success category-button" type="button" data-bs-toggle="collapse" data-bs-target="#myClasses" aria-expanded="false" aria-controls="myClasses" style="background-color: #EEC643;">
       My Classes
    </button>
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
            ];

            // Create map markers
            const markers = {};
            const academicMarkers = [];
            const athleticMarkers = [];
            const serviceMarkers = [];
            
            // Track the currently visible marker
            let currentMarker = null;

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

            // Toggle sidebar
            document.getElementById('sidebar-toggle').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('collapsed');
            });

            // Category buttons functionality
            document.querySelectorAll('.category-button').forEach(button => {
                button.addEventListener('click', function() {
                    this.classList.toggle('collapsed');
                    // This now just expands/collapses the location list
                });
            });

            // Location buttons event listeners
            document.querySelectorAll('.location-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const lat = parseFloat(this.getAttribute('data-lat'));
                    const lng = parseFloat(this.getAttribute('data-lng'));
                    const locationName = this.textContent.trim();
                    
                    // Pan to location
                    map.setView([lat, lng], 19);
                    
                    // Show the marker
                    showMarker(locationName);
                });
            });

            // Location dropdown event listener
            document.getElementById('location-select').addEventListener('change', function() {
                const selectedName = this.value;
                
                if (!selectedName) return; // Do nothing if default option is selected
                
                const locationInfo = locationMarkers.find(loc => loc.name === selectedName);
                
                if (locationInfo) {
                    // Pan to location
                    map.setView([locationInfo.lat, locationInfo.lng], 19);
                    
                    // Show the marker
                    showMarker(selectedName);
                    
                    // Reset dropdown to default option after action
                    this.value = "";
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
        } catch (error) {
            console.error('Error initializing map:', error);
        }
    });
</script>
</body>
</html>