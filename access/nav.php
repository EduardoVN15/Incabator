<nav>
    <div class="nav-container">
        <ul>
            <li><a href="../access/land.php">Home</a></li>
            <li><a href="../users/profile.php">Profile</a></li>
            <li><a href="../users/schedule.php">Schedule</a></li>
            <li><a href="../search/searchpage.php">Class Search</a></li>
            <li><a href="../map/map.php">Map</a></li>
        </ul>
       <div id="nav-time">
    	    <span id="clock"></span>
   	 	    <span id="period"></span>
	   </div>

    </div>
</nav>

<script>
function updateClockAndPeriod() {
    const now = new Date();
    const hour = now.getHours();
    const minute = now.getMinutes();
    const second = now.getSeconds();

    const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    document.getElementById('clock').textContent = timeString;

    // Convert current time to minutes since midnight for easy comparison
    const nowMinutes = hour * 60 + minute;

    const periods = [
        { start: 8 * 60 + 30, end: 9 * 60 + 20, label: "Period 1" },
        { start: 9 * 60 + 26, end: 10 * 60 + 16, label: "Period 2" },
        { start: 10 * 60 + 30, end: 11 * 60 + 20, label: "Period 3" },
        { start: 11 * 60 + 26, end: 12 * 60 + 18, label: "Period 4" },
        { start: 12 * 60 + 54, end: 13 * 60 + 44, label: "Period 5" },
        { start: 13 * 60 + 50, end: 14 * 60 + 40, label: "Period 6" },
        { start: 14 * 60 + 46, end: 15 * 60 + 36, label: "Period 7" },
    ];

    const currentPeriod = periods.find(p => nowMinutes >= p.start && nowMinutes <= p.end);
    document.getElementById('period').textContent = currentPeriod ? currentPeriod.label + " " : " ";
}

setInterval(updateClockAndPeriod, 1000);
updateClockAndPeriod();
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
	
#nav-time {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    font-family: monospace;
    font-weight: bold;
    white-space: nowrap;
}

#period {
    color: white; /* gold or any highlight color */
}

</style>
