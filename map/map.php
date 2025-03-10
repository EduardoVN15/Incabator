<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Navigator - Home</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    
    <style>
        #map {
            width: 100vw;
            height: 100vh;
        }
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: white;
            padding: 15px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }
        #sidebar button {
            width: 100%;
            margin-bottom: 10px;
        }
        #toggle-btn {
            position: fixed;
            top: 10px;
            left: 260px;
            background: #007bff;
            color: white;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body>

    <!-- Sidebar for location buttons -->
    <div id="sidebar">
        <h4>Locations</h4>
       <button onclick="goToLocation(32.7825, -116.9864, 18.42)">English</button>
        <button onclick="goToLocation(32.7812241,-116.9874599,19.97)">Art/office</button>
        <button onclick="goToLocation(41.8781, -87.6298)">Chicago</button>
    </div>

    <!-- Toggle Sidebar Button -->
    <button id="toggle-btn" onclick="toggleSidebar()">☰ Menu</button>

    <!-- Map Container -->
    <div id="map"></div>

    <script>
        // Initialize the map
        var map = L.map('map').setView([40.73061, -73.935242], 10);

        // Load map tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Function to move map to selected location
        function goToLocation(lat, lng) {
            map.setView([lat, lng], 12);
        }

        // Function to toggle sidebar
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            if (sidebar.style.transform === "translateX(-250px)") {
                sidebar.style.transform = "translateX(0)";
            } else {
                sidebar.style.transform = "translateX(-250px)";
            }
        }
    </script>

</body>
</html>
