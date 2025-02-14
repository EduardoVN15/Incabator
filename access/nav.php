<?php
// Start the session
session_start();
?>

<nav>
    <ul>
        <!-- Link to the home page -->
        <li><a href="../access/land.php">Home</a></li>
        <!-- Always display these links -->
        <li><a href="../users/profile.php">Profile</a></li>
        <li><a href="../map/map.php">Map</a></li>
    </ul>
</nav>

<style>
    /* Remove default margin and padding from the page */
    body, html {
        margin: 0;
        padding: 0;
    }

    /* Basic styling for the navigation bar */
    nav {
        background-color: #0F1158;
        padding: 1rem;
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
</style>
