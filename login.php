<?php
require_once('config.php');

// Set session cookie parameters to ensure the cookie expires when the browser is closed
session_set_cookie_params([
    'lifetime' => 0, // Session cookie will expire when the browser is closed
    'path' => '/',
    'domain' => '', // You can set your domain here if needed
    'secure' => isset($_SERVER['HTTPS']), // Set to true if using HTTPS
    'httponly' => true, // Makes the cookie accessible only through the HTTP protocol
    'samesite' => 'Lax' // Adjust this value based on your needs
]);

session_start(); // Starts the session. //This line of code initiates a session in PHP. Sessions are a way to
// preserve data across subsequent HTTP requests.
// session_start() must be called before any output is sent to the browser, typically at the beginning of
// a script. It initializes a session or resumes the current one if it exists.

// Check if the form is submitted
if (isset($_POST['login'])) {

    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement
    $sql = "SELECT * FROM Users_simpleLogin WHERE userName = ? AND hashedPword = ?"; // Update this query as per your database schema
    $stmtSelect = $pdo->prepare($sql);

    // Execute the prepared statement
    $stmtSelect->execute([$username, $password]); // Note: Using plain passwords here. In a real scenario, use hashed passwords.
    $user = $stmtSelect->fetch();

    // Check if the user was found
    if ($user) {
        $_SESSION['username'] = $username; // Set the session variable
        header("Location: session.php"); // Redirect to session.php
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login | PHP</title>
    <!-- Use Bootstrap CDN for stylesheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .form-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-box {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="container form-container">
    <div class="form-box">
        <h1 class="text-center">Login</h1>
        <p class="text-center">Please enter your credentials</p>
        <form action="login.php" method="post">
            <!-- Username field -->
            <div class="form-group">
                <label for="username">Username:</label>
                <input class="form-control" type="text" name="username" required id="username" placeholder="Your Username">
            </div>
            <!-- Password field -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input class="form-control" type="password" name="password" required id="password" placeholder="Your Password">
            </div>
            <button class="btn btn-primary btn-block" type="submit" name="login">Login</button>
        </form>
        <p class="text-center mt-3"><a href="register.php">Don't have an account? Sign up here</a></p>
    </div>
</div>
<!-- Use Bootstrap and jQuery CDN for scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
