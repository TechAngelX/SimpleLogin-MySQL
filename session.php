<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logged In</title>
    <!-- Use Bootstrap CDN for stylesheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .card {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card text-center">
        <div class="card-header">
            Welcome
        </div>
        <div class="card-body">
            <h5 class="card-title">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h5>
            <p class="card-text">You are successfully logged in.</p>
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>
</div>

<!-- Use Bootstrap and jQuery CDN for scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
