<?php
// Preset credentials
// Preset credentials
$presetName = "user";
$presetPassword = "password123";

// Get submitted name and password
$name = $_POST['username'];
$password = $_POST['password'];

// Check if name and password match the preset values
if ($name === $presetName && $password === $presetPassword) {
    // Redirect to land.php
    header("Location: /land.php");
    exit(); // Important to prevent further code execution after redirect
} else {
    // Incorrect credentials
    echo "Error: Incorrect name or password.";
}
?>