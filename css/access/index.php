<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modern Business Template</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/startbootstrap-modern-business-gh-pages/css/styles.css" rel="stylesheet">
</head>
<body>
    <?php
    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'login':
                header('Location: login.php');
                exit();
            case 'registration':
                header('Location: registration.php');
                exit();
        }
    }
    ?>

    <div class="container">
        <form method="post" class="mt-4">
            <button type="submit" name="action" value="login" class="btn btn-primary me-2">Login</button>
            <button type="submit" name="action" value="registration" class="btn btn-secondary">Registration</button>
        </form>

        <h1 class="mt-4 mb-3">Welcome to Modern Business</h1>
        <p>This is your homepage using the Modern Business template!</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>