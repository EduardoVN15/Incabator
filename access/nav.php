<nav>
    <div class="nav-container">
        <ul>
            <li><a href="../access/land.php">Home</a></li>
            <li><a href="../users/profile.php">Profile</a></li>
            <li><a href="../users/schedule.php">Schedule</a></li>
            <li><a href="../search/searchpage.php">Class Search</a></li>
            <li><a href="../map/map.php">Map</a></li>
        </ul>
        <div id="clock"></div>
    </div>
</nav>

<script>
function updateClock() {
    const now = new Date();
    const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    document.getElementById('clock').textContent = timeString;
}
setInterval(updateClock, 1000);
updateClock(); // Initial call
</script>

<style>
nav {
    background-color: #0F1158;
    padding: 1rem;
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
}

.nav-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding: 0 2rem;
    box-sizing: border-box;
}
nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 1rem;
}

nav ul li {
    display: inline;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

nav ul li a:hover {
    text-decoration: underline;
}

#clock {
    color: white;
    font-weight: bold;
    font-family: monospace;
    font-size: 1rem;
    white-space: nowrap; /* Prevent it from wrapping */
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Push content down */
body {
    padding-top: 60px;
}
</style>
