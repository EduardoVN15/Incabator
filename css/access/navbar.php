<?php
// Get the current page name for highlighting active links
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Campus Navigator</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'land.php') ? 'active' : ''; ?>" 
                       href="/land.php">land.php</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'map.php') ? 'active' : ''; ?>" 
                       href="/maps/map.php">Map</a>
                </li>
				  <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'profilePage.php') ? 'active' : ''; ?>" 
   href="/access/profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
