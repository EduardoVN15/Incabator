<?php
session_start();
?>

<nav>
    <ul>
        <!-- Link to the home page -->
        <li><a href="../access/land.php">Home</a></li>
        <!-- Always display these links -->
        <li><a href="../users/profile.php">Profile</a></li>
		<li><a href="../users/schedule.php">Schedule</a></li>
		<li><a href="../search/searchpage.php">Class Search</a></li>
        <li><a href="../map/map.php">Map</a></li>
    </ul>
</nav>

<style>
   nav {
    background-color: #0F1158;
    padding: 1rem;
    width: 100%;
    position: fixed; /* Keeps it at the top */
    top: 0;
    left: 0;
    z-index: 1000; /* Ensures it's above other elements */
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

/* Push content down so it does not get hidden behind the fixed navbar */
body {
    padding-top: 60px; /* Adjust according to nav height */
}

</style>
