<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sophia's Contact Information</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	
	 <?php include 'nav.php'; ?> <!-- Include the navigation bar -->


   <div class="info-container">
        <h1>Sophia's Contact Information</h1>
		
		<p>
            <?php
            // Check if GET data exists for a message
            if (isset($_GET['message']) && !empty($_GET['message'])) {
                echo "Message from previous page: " . htmlspecialchars(trim($_GET['message']));
            } else {
                echo "No message received from the previous page.";
            }
            ?>
        </p>
		
        <select id="info" onchange="displayInfo()">
            <option value="">--Select--</option>
            <option value="email">Email</option>
            <option value="insta">Instagram</option>
            <option value="phone">Phone Number</option>
            <option value="replit">Replit User</option>
            <option value="githubEmail">GitHub Email</option>
            <option value="githubUser">GitHub User</option>
        </select>

        <p id="display"></p>
    </div>

    <script>
        function displayInfo() {
            const info = document.getElementById("info").value;
            let displayText = "";

            switch (info) {
                case "email":
                    displayText = "Email: 370824@guhsd.net";
                    break;
                case "insta":
                    displayText = "Instagram: marsthepirates";
                    break;
                case "phone":
                    displayText = "Phone Number: 619-613-9080";
                    break;
                case "replit":
                    displayText = "Replit User: SOPHIAMARSTELLE";
                    break;
                case "githubEmail":
                    displayText = "GitHub Email: sophiamars24@gmail.com";
                    break;
                case "githubUser":
                    displayText = "GitHub User: SMars24";
                    break;
                default:
                    displayText = "";
            }

            document.getElementById("display").innerText = displayText;
        }
    </script>

</body>
</html>