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
            <button class="btn btn-success category-button" type="button" id="myClassesBtn" style="background-color: #EEC643;" data-bs-toggle="collapse" data-bs-target="#myClasses" aria-expanded="false" aria-controls="myClasses">
                My Classes
            </button>
            <div class="collapse location-list" id="myClasses">
                <!-- Class buttons will be dynamically added here -->
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
            
            // Track current points and path
            let startPoint = null;
            let endPoint = null;
            let pathLine = null;
            
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
            
            // Function to handle location button clicks
            function handleLocationClick(locationName) {
                const location = locationMarkers.find(loc => loc.name === locationName);
                
                if (location) {
                    // Pan to location
                    map.setView([location.lat, location.lng], 19);
                    
                    // Update selected location
                    updateSelectedLocation(location);
                    
                    // Show the regular marker temporarily
                    const marker = markers[locationName];
                    marker.addTo(map).openPopup();
                    
                    // Remove the regular marker after a short delay
                    setTimeout(() => {
                        if (map.hasLayer(marker)) {
                            map.removeLayer(marker);
                        }
                    }, 100);
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

            // Location buttons event listeners
            document.querySelectorAll('.location-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const locationName = this.textContent.trim();
                    handleLocationClick(locationName);
                });
            });

            // Location dropdown event listener
            document.getElementById('location-select').addEventListener('change', function() {
                const selectedName = this.value;
                
                if (!selectedName) return; // Do nothing if default option is selected
                
                handleLocationClick(selectedName);
                
                // Reset dropdown to default option after action
                this.value = "";
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
            
            // Add class buttons
            classSchedule.forEach(item => {
                // Find the building coordinates
                const buildingInfo = locationMarkers.find(loc => loc.name === item.building);
                
                if (buildingInfo) {
                    const button = document.createElement('button');
                    button.className = 'btn btn-outline-warning location-btn';
                    button.textContent = `Period ${item.period}: ${item.class} (Room ${item.room})`;
                    
                    // Add click event to navigate to the location
                    button.addEventListener('click', function() {
                        handleLocationClick(item.building);
                    });
                    
                    myClassesDiv.appendChild(button);
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

            console.log('Map initialized successfully with navigation features');
        } catch (error) {
            console.error('Error initializing map:', error);
        }
    });
    </script>
</body>
</html>