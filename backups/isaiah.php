<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isaiah's Contact Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="info-container">
        <h1>Isaiah's Contact Information</h1>
        <p>
            <?php
            // Check if GET data exists for a message
            if (isset($_GET['message']) && !empty($_GET['message'])) {
                echo "Message from previous page: " . htmlspecialchars(trim($_GET['message']));
            } else {
                echo "No message received from the previous page.";
            }
            ?>
			
        <p>Email: 376949@guhsd.net</p>
        <p>Instagram: favgnagga</p>
        <p>Phone Number: 619-718-1293</p>
        <p>Replit User: @ISAIAHSOLORIO</p>
        <p>GitHub Email:</p>
        <p>GitHub User:</p>
		
	</div>	

    </script>
</body>
</html>
