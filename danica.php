<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danica's Contact Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="info-container">
        <h1>danica's Contact Information</h1>


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

        <p>Email: 376651@guhsd.net</p>
        <p>Instagram: eduardovn15</p>
        <p>Phone Number: 619-368-0481</p>
        <p>Snapchat: Eduardo Verdin</p>
        <p>Replit User: @EDUARDOVERDIN1</p>
        <p>GitHub Email: eduardoverdin2008@gmail.com</p>
        <p>GitHub User: EduardoVN15</p>
    </div>

</body>
</html>
