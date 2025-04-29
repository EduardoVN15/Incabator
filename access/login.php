<?php session_start();?>
<html>
<head>
    <link href="/css2/styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Login Form</title>
</head>
<body>
	<div class="container">
		<div class="contact-form">
			<h2 class="login-title">Login</h2>
			<form action="/access/loginHandler.php" method="POST">
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" id="username" name="username" required>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" required>
				</div>
				<button type="submit" class="submit-btn">Login</button>
			</form>
		</div>
	</div>
</body>
</html>