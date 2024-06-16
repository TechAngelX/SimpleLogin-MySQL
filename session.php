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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logged In</title>
    <!-- Use Bootstrap CDN for stylesheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .card {
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;
        }
        .data-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .item-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        .item-container img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<nav>
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
        <h1>Fetching Data with Ajax and PHP</h1>
        <a href="#" id="fetch-data" class="btn btn-primary">Display Message</a>
        <div id="data-container" class="data-container">
            Original Data. Fetched Data Goes Here.
        </div>
    </div>
</nav>

<!-- Use Bootstrap and jQuery CDN for scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#fetch-data').on('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            $.ajax({
                url: 'data.php',
                method: 'GET',
                success: function(data) {
                    $('#data-container').empty(); // Clear any existing content
                    data.forEach(function(item) {
                        var itemContainer = $('<div>').addClass('item-container');
                        var imgElement = $('<img>').attr('src', item.image);
                        var textElement = $('<p>').text(item.text);
                        itemContainer.append(imgElement).append(textElement);
                        $('#data-container').append(itemContainer);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX request failed: ' + textStatus + ', ' + errorThrown);
                    $('#data-container').html('Failed to fetch data.');
                }
            });
        });
    });
</script>
</body>
</html>
