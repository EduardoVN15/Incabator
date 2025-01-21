<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $department = trim($_POST['department']);
    $message = trim($_POST['message']);

    // Initialize an array for errors
    $errors = [];

    // Validate full name (First Last format)
    if (!preg_match("/^[A-Za-z]+ [A-Za-z]+$/", $name)) {
        $errors[] = "Name must be in 'First Last' format.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    // Validate department (non-empty and alphanumeric)
    if (empty($department) || !preg_match("/^[A-Za-z0-9 ]+$/", $department)) {
        $errors[] = "Please enter a valid department.";
    }

    // Validate message (non-empty and reasonable length)
    if (empty($message) || strlen($message) > 500) {
        $errors[] = "Message is required and must be less than 500 characters.";
    }

    // If there are validation errors, redirect back with the error messages
    if (!empty($errors)) {
        $errorString = implode(", ", $errors);
        header("Location: index.php?message=" . urlencode($errorString));
        exit();
    }

    // If validation passes, urlencode the form data and redirect
    $name = urlencode($name);
    $email = urlencode($email);
    $department = urlencode($department);
    $message = urlencode($message);

    header("Location: indexSubmit.php?name=$name&email=$email&department=$department&message=$message");
    exit(); // Always exit after a redirect
} else {
    // Redirect back to index.php with an error message if form not submitted via POST
    $error = "Please complete the form and try again.";
    header("Location: index.php?message=" . urlencode($error));
    exit();
}
?>