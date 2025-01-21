<?php
session_start();

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
        $errors['name'] = "Name must be in 'First Last' format.";
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email address.";
    }
    
    // Validate department (non-empty and alphanumeric)
    if (empty($department) || !preg_match("/^[A-Za-z0-9 ]+$/", $department)) {
        $errors['department'] = "Please enter a valid department.";
    }
    
    // Validate message (non-empty and reasonable length)
    if (empty($message) || strlen($message) > 500) {
        $errors['message'] = "Message is required and must be less than 500 characters.";
    }
    
    // If there are validation errors, store them in session and redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST; // Store form data to repopulate the form
        header("Location: index.php");
        exit();
    }
    
    // If validation passes, proceed with form submission
    // (You might want to process the data here instead of redirecting)
    header("Location: indexSubmit.php");
    exit();
} else {
    // Redirect back to index.php with an error message if form not submitted via POST
    $_SESSION['errors'] = ["general" => "Please complete the form and try again."];
    header("Location: index.php");
    exit();
}
?>