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
            width: 250px;
            height: calc(100vh - 80px);
            background-color: rgba(255, 255, 255, 0.9);
            z-index: 1000;
            padding: 20px;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        #sidebar.collapsed {
            right: -220px;
        }
        #sidebar .btn {
            width: 100%;
            margin-bottom: 10px;
            text-align: left;
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
        <h5 class="mb-3">Options</h5>
        <button class="btn btn-primary mb-3" id="btn-buildings">
            <i class="bi bi-building"></i> English
        </button>
        <button class="btn btn-success mb-3" id="btn-classrooms">
            <i class="bi bi-door-open"></i> Art/office
        </button>
        <button class="btn btn-info mb-3" id="btn-facilities">
            <i class="bi bi-shop"></i> Bio/Science
        </button>
        
        <!-- You can add your location select dropdown here -->
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

            // Toggle sidebar
            document.getElementById('sidebar-toggle').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('collapsed');
            });

            // Button event listeners
            document.getElementById('btn-buildings').addEventListener('click', function() {
                // Filter to show only buildings
                console.log('Show buildings only');
                // Implement your filter logic here
            });

            document.getElementById('btn-classrooms').addEventListener('click', function() {
                // Filter to show only classrooms
                console.log('Show classrooms only');
                // Implement your filter logic here
            });

            document.getElementById('btn-facilities').addEventListener('click', function() {
                // Filter to show only facilities
                console.log('Show facilities only');
                // Implement your filter logic here
            });

            // Fetch locations from PHP
            fetch('fetch_locations.php')
                .then(response => response.json())
                .then(data => {
                    const selectBox = document.getElementById('location-select');
                    const buildings = [];
                    const classrooms = [];
                    const facilities = [];

                    data.forEach(location => {
                        if (location.type === "Building" && location.boundary) {
                            // Add polygons for buildings
                            const polygon = L.polygon(location.boundary, {
                                color: 'blue',
                                fillColor: 'lightblue',
                                fillOpacity: 0.5
                            }).addTo(map);

                            buildings.push(polygon);

                            // Add popup for the polygon
                            polygon.bindPopup(`<strong>${location.name}</strong><br>${location.type}`);

                            // Add hover effects
                            polygon.on('mouseover', function () {
                                this.setStyle({ color: 'red', fillColor: 'pink' });
                            });
                            polygon.on('mouseout', function () {
                                this.setStyle({ color: 'blue', fillColor: 'lightblue' });
                            });

                            // Add to dropdown
                            const option = document.createElement('option');
                            option.value = location.name;
                            option.textContent = location.name;
                            selectBox.appendChild(option);

                        } else {
                            // Add markers for other types (e.g., classrooms)
                            const marker = L.marker([location.latitude, location.longitude])
                                .addTo(map)
                                .bindPopup(`<strong>${location.name}</strong><br>${location.type}`);
                            
                            if (location.type === "Classroom") {
                                classrooms.push(marker);
                            } else {
                                facilities.push(marker);
                            }

                            // Add to dropdown
                            const option = document.createElement('option');
                            option.value = location.name;
                            option.textContent = location.name;
                            selectBox.appendChild(option);
                        }
                    });

                    // Filter button logic implementation
                    document.getElementById('btn-buildings').addEventListener('click', function() {
                        buildings.forEach(b => b.addTo(map));
                        classrooms.forEach(c => map.removeLayer(c));
                        facilities.forEach(f => map.removeLayer(f));
                    });

                    document.getElementById('btn-classrooms').addEventListener('click', function() {
                        classrooms.forEach(c => c.addTo(map));
                        buildings.forEach(b => map.removeLayer(b));
                        facilities.forEach(f => map.removeLayer(f));
                    });

                    document.getElementById('btn-facilities').addEventListener('click', function() {
                        facilities.forEach(f => f.addTo(map));
                        buildings.forEach(b => map.removeLayer(b));
                        classrooms.forEach(c => map.removeLayer(c));
                    });

                    // Add event listener for dropdown
                    selectBox.addEventListener('change', function () {
                        const selectedName = this.value;
                        const selectedLocation = data.find(location => location.name === selectedName);

                        if (selectedLocation) {
                            if (selectedLocation.type === "Building" && selectedLocation.boundary) {
                                // Zoom to the building's polygon
                                const polygonBounds = L.polygon(selectedLocation.boundary).getBounds();
                                map.fitBounds(polygonBounds);
                            } else {
                                // Zoom to the classroom marker
                                map.setView([selectedLocation.latitude, selectedLocation.longitude], 19);
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching locations:', error));

            console.log('Map initialized successfully');
        } catch (error) {
            console.error('Error initializing map:', error);
        }
    });
</script>
</body>
</html>