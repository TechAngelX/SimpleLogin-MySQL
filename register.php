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

// Initialize $email variable
$email = "";

// Check if the form is submitted
if (isset($_POST['create'])) {

    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $passwordConfirmation = $_POST["password-confirm"];

    // Validate form data (you may want to add more validation or turn off validation)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format. <br>";
        // You can choose to exit here if you want to stop further processing,
        // or you can just display the error message and continue.
        // exit;
    }
    if ($password !== $passwordConfirmation) {
        echo "Passwords do not match. ";
        // Don't redirect, display message instead
        echo "Passwords do not match.";
        exit;
    }
    // Prepare SQL statement
    $sql = "INSERT INTO Users_simpleLogin (userName, hashedPword, email) VALUES (?, ?, ?)"; // Here, these must correspond to the database field names.
    $stmtInsert = $pdo->prepare($sql);

    // Execute the prepared statement
    $result = $stmtInsert->execute([$username, $password, $email]); // Not the fields from your database.

    // Check if the user was submitted successfully
    if ($result) {
        $_SESSION['username'] = $username; // Set the session variable
        header("Location: session.php"); // Redirect to session.php
        exit();
        // echo  "User Submitted:  " . $username . " " . $password . " " . $email;
    } else {
        echo "Error: Unable to submit user."; // Display error message
    }
}

// Generate a random validation code
$validationCode = substr(md5(uniqid(mt_rand(), true)), 0, 8);

// Store the validation code in the session for later verification
$_SESSION['validation_code'] = $validationCode;

// Send email to home address with validation code
$to = "your-email@example.com"; // Change this to your home email address
$subject = "New User Registration - Validation Code";
$message = "Username: $username\nEmail: $email\nValidation Code: $validationCode";
$headers = "From: $email";
mail($to, $subject, $message, $headers);

?>


<!DOCTYPE html>
<html>
<head>
    <title>User Registration | PHP</title>
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
        <h1 class="text-center">Registration</h1>
        <p class="text-center">Please complete the form</p>
        <form action="register.php" method="post">
            <!-- Username field -->
            <div class="form-group">
                <label for="username"><strong>Username:</strong></label>
                <input class="form-control" type="text" name="username" required id="username" placeholder="Enter a username">
            </div>
            <!-- Password and Confirm Password fields on the same row -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password"><strong>Password:</strong></label>
                    <input class="form-control" type="password" name="password" required id="password" >
                </div>
                <div class="form-group col-md-6">
                    <label for="password-confirm"><strong>Confirm Password:</strong> </label>
                    <input type="password" class="form-control" id="password-confirm" name="password-confirm" >
                </div>
            </div>

            <!-- Error message for passwords mismatch -->
            <p id="password-mismatch-error" class="text-danger"></p>

            <!-- Email Address field -->
            <div class="form-group">
                <label for="email"><strong>Email</strong></label>
                <input class="form-control" type="email" name="email" placeholder="Enter email address...">
                <p id="email-validation-error" class="text-danger"></p>




                <small id="email" class="form-text text-muted"><span class="text-danger">* Optional</span></small>
            </div>
            <!-- Sign Up button -->
            <button class="btn btn-primary btn-block" type="submit" name="create">Sign Up</button>
        </form>
        <!-- Already registered link -->
        <p class="text-center mt-3"><a href="login.php">Already registered? Click here to log in</a></p>
    </div>
</div>
<!-- Use Bootstrap and jQuery CDN for scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Function to check if passwords match
    function checkPasswordMatch() {
        var password = $("#password").val();
        var confirmPassword = $("#password-confirm").val();

        if (password !== confirmPassword) {
            // Display error message
            $("#password-mismatch-error").text("Passwords do not match");
        } else {
            // Clear error message if passwords match
            $("#password-mismatch-error").text("");
        }
    }

    // Function to check email validation
    function checkEmailValidation() {
        var email = $("#email").val();
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email)) {
            // Display error message
            $("#email-validation-error").text("Invalid email format");
        } else {
            // Clear error message if email is valid
            $("#email-validation-error").text("");
        }
    }

    // Check password match on input change
    $("#password-confirm").on("keyup", checkPasswordMatch);

    // Check email validation on input change
    $("#email").on("keyup", checkEmailValidation);
</script>
</body>
</html>

