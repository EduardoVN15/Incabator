<?php
// Retrieve form data from GET parameters
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'N/A';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : 'N/A';
$department = isset($_GET['department']) ? htmlspecialchars($_GET['department']) : 'N/A';
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'N/A';

// Check if form was properly submitted via POST and passed to this page
$properSubmission = isset($_GET['name']) && isset($_GET['email']) && isset($_GET['department']) && isset($_GET['message']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Confirmation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="confirmation-page">
        <!-- If form data is missing, display an error message -->
        <?php if (!$properSubmission): ?>
            <h2>Oops! You arrived here incorrectly.</h2>
            <p>Please fill out the form and try again by clicking <a href="index.php">here</a>.</p>
        <?php else: ?>
            <h2>Form Submitted Successfully!</h2>
        <?php endif; ?>

        <!-- Display form data or "N/A" if not properly submitted -->
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Department:</strong> <?php echo $department; ?></p>
        <p><strong>Message:</strong> <?php echo nl2br($message); ?></p> <!-- Converts newlines in the message to <br> -->
    </div>

</body>
</html>