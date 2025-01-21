<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize inputs
    $name = trim($_POST['name']);  // This is now a text input, doesn't affect redirection
    $person = trim($_POST['person']);  // This is the dropdown selection
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Initialize an array for errors
    $errors = [];

    // Validate person (ensure it's one of the options in the dropdown)
    $valid_persons = ['eduardo', 'danica', 'sophia', 'lily', 'isaiah'];
    if (!in_array($person, $valid_persons)) {
        $errors[] = "Invalid person selection.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    // Validate message (non-empty and reasonable length)
    if (empty($message) || strlen($message) > 500) {
        $errors[] = "Message is required and must be less than 500 characters.";
    }

    // If there are validation errors, redirect back with the error messages
    if (!empty($errors)) {
        $errorString = implode(", ", $errors);
        header("Location: index2.php?message=" . urlencode($errorString));
        exit();
    }

    // If validation passes, urlencode the form data
    $name = urlencode($name);
    $person = urlencode($person);
    $email = urlencode($email);
    $message = urlencode($message);

    // Redirect to specific pages based on the selected person
    switch ($person) {
        case 'sophia':
            header("Location: sophia.php?name=$name&email=$email&message=$message");
            break;
        case 'lily':
            header("Location: lily.php?name=$name&email=$email&message=$message");
            break;
        case 'danica':
            header("Location: danica.php?name=$name&email=$email&message=$message");
            break;
        case 'eduardo':
            header("Location: eduardo.php?name=$name&email=$email&message=$message");
            break;
        case 'isaiah':
            header("Location: isaiah.php?name=$name&email=$email&message=$message");
            break;
        default:
            // If no matching file is found, return an error message
            $error = "Named file not yet created.";
            header("Location: index2.php?message=" . urlencode($error));
            break;
    }

    exit(); // Always exit after a redirect
} else {
    // Redirect back to index2.php with an error message if form not submitted via POST
    $error = "Please complete the form and try again.";
    header("Location: index2.php?message=" . urlencode($error));
    exit();
}
?>
