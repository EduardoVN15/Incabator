//document.addEventListener('DOMContentLoaded', function () {
//    const map = L.map('map').setView([32.7814, -116.9929], 18); // Adjust coordinates and zoom as needed
//
//    // Add a basic tile layer to the map
//    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
//        maxZoom: 19,
//        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
//    }).addTo(map);
//
//    // Fetch location data from the fetchLocations.php file
//    fetch('/map/fetchLocations.php')
//        .then(response => response.json())
//        .then(data => {
//            // Loop through the location data and add markers to the map
//            data.forEach(location => {
//                L.marker([location.latitude, location.longitude])
//                    .addTo(map)
//                    .bindPopup(location.name);
//            });
//        })
//        .catch(error => console.error('Error fetching locations:', error));
//});