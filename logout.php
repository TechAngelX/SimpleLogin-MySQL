<?php
session_start();
session_unset();
session_destroy();
const REDIRECT_TIME = 4;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Goodbye</title>
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
    <script>
        // Redirect to index.php after n seconds
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 4000);
    </script>
</head>
<body>
<div class="container">
    <div class="card text-center">
        <div class="card-header">
            Goodbye
        </div>
        <div class="card-body">
            <h5 class="card-title">See you soon!</h5>
            <p class="card-text">You have been logged out. You will be redirected to the homepage in 4 seconds.</p>
        </div>
    </div>
</div>

<!-- Use Bootstrap and jQuery CDN for scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
