<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="info-container">
        <h1>Lily's Contact Information</h1>

		
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
		
        <p>Email: 371797@guhsd.net</p>
        <p>Instagram:</p>
        <p>Phone Number: 619-890-7334</p>
        <p>Replit User: LILYSYKES1</p>
        <p>GitHub Email: lilyannsykes@gmail.com</p>
        <p>GitHub User: Lily-Syk</p>
    </div>

</body>
</html>
