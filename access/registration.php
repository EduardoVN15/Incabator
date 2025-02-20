<!doctype html>
<html lang="en">
<link href="/css/styles.css" rel="stylesheet">
<!-- This line declares the type of document, telling the browser that this is an HTML5 document. 
     'lang="en"' specifies that the language of the document is English. -->
<head>
    <!-- This section contains metadata and links to external resources. -->

    <meta charset="UTF-8">
    <!-- Specifies the character encoding for the document. 'UTF-8' supports most characters in all languages. -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- This tag makes the page responsive, meaning it will adjust its layout to look good on all devices. -->

    <title>Registration Form</title>
    <!-- The text inside <title> tags will appear as the name of the tab in the browser. -->

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- This is a link to the Bootstrap library, a framework that makes it easier to design web pages. 
         'rel="stylesheet"' tells the browser this is a stylesheet for the page. -->
</head>

<body>
    <!-- The <body> tag contains all the content visible on the web page. -->

    <div class="container">
        <!-- This <div> (short for "division") is a container. 
             'class="container"' applies Bootstrap's styles to give the content some padding and center it on the page. -->

        <div class="registration-form">
            <!-- This <div> is for the registration form. 
                 It groups all the form elements together and applies the class 'registration-form' for styling. -->

            <h2 class="registration-title">Create Account</h2>
            <!-- This is a header (title) for the form. 
                 'class="registration-title"' can be used to style this specific header differently. -->

           <form method="POST" action="/access/regHandler.php">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br>
			   
	<label for="gradeLevel">Gradelevel:</label>
	<select name="gradeLevel" id="gradeLevel" required>
    <option value="">Select a grade</option>
    <?php
    for ($grade = 9; $grade <= 12; $grade++) {
        echo "<option value=\"$grade\">$grade</option>";
    }
    ?>
	</select><br>
			   
	<label for="studentId">studentId:</label>
	<input type="text" name="studentId" id="studentId" 
       pattern="[0-9]{6}" 
       title="Student ID must be 6 digits (numbers only)" 
       maxlength="6" 
       oninput="this.value = this.value.replace(/[^0-9]/g, '')"
       value="<?php echo isset($_POST['studentId']) ? htmlspecialchars($_POST['studentId']) : ''; ?>"
       required><br>

   <label for="email">Email:</label>
<input type="email" 
       name="email" 
       id="email" 
       pattern="[a-zA-Z0-9._%+-]+@guhsd\.net$"
       title="Please enter a valid @guhsd.net email address"
       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
       required><br>

<?php
// Server-side validation (place this in your form processing PHP file)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Validate email domain is guhsd.net
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._%+-]+@guhsd\.net$/', $email)) {
        $error = "Please enter a valid @guhsd.net email address";
        // Handle the error (display message, redirect, etc.)
    } else {
        // Process valid email
        // ...
    }
}
?>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>

    <label for="confirmPassword">Confirm Password:</label>
    <input type="password" name="confirmPassword" id="confirmPassword" required><br>

    <button type="submit">Register</button>
</form>

        </div>
    </div>
</body>

</html>