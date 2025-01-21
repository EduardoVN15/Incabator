<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="contact-form">
        <h2>Contact Us!</h2>
        <form action="/indexHandler.php" method="POST">
            <!-- Updated name field to a text input -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <!-- Email field -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- Message field -->
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            
            <!-- Person dropdown (used for redirection) -->
            <div class="form-group">
                <label for="person">Person:</label>
                <select id="person" name="person" required>
                    <option value="eduardo">Eduardo</option>
                    <option value="danica">Danica</option>
                    <option value="sophia">Sophia</option>
                    <option value="lily">Lily</option>
                    <option value="isaiah">Isaiah</option>
                    <!-- Add more options here if needed -->
                </select>
            </div>

            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div>

</body>
</html>
