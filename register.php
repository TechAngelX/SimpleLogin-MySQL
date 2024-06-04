<?php
require_once('config.php');
session_start(); // Starts the session. //This line of code initiates a session in PHP. Sessions are a way to
// preserve data across subsequent HTTP requests.
// session_start() must be called before any output is sent to the browser,typically at the beginning of
// a script. It initializes a session or resumes the current one if it exists.

// Check if the form is submitted
if (isset($_POST['create'])) {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Prepare SQL statement
    $sql = "INSERT INTO Users_mySite (userName, hashedPword, email) VALUES (?, ?, ?)"; // Here, these must correspond to the database field names.
    $stmtInsert = $pdo->prepare($sql);

    // Execute the prepared statement
    $result = $stmtInsert->execute([$username, $password, $email]); // Not the fields from your databbase.

    // Check if the user was submitted successfully
    if($result) {
        $_SESSION['username'] = $username; // Set the session variable
        header("Location: logged_in.php"); // Redirect to logged_in.php
        exit();
        // echo  "User Submitted:  " . $username . " " . $password . " " . $email;

    } else {
        echo "Error: Unable to submit user."; // Display error message
    }
}


// Check if the form is submitted
if (isset($_POST['create'])) {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Prepare SQL statement
    $sql = "INSERT INTO Users_mySite (userName, hashedPword, email) VALUES (?, ?, ?)"; // Here, these must correspond to the database field names.
    $stmtInsert = $pdo->prepare($sql);

    // Execute the prepared statement
    $result = $stmtInsert->execute([$username, $password, $email]); // Not the fields from your databbase.

    // Check if the user was submitted successfully
    if ($result) {
        echo "User submitted successfully."; // Display success message
        // echo  "User Submitted:  " . $username . " " . $password . " " . $email;

    } else {
        echo "Error: Unable to submit user."; // Display error message
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration | PHP</title>

    <!-- For local/offline use: <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.rtl.min.css">
    -->
    <!-- For online use: -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div>

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h1>Registration</h1>
                <p>Please complete the form</p>
                <form action="register.php" method="post">
                    <label for="username">Username:</label>
                    <input class="form-control" type="text" name="username" required id="username" placeholder="Your Username">

                    <label for="password">Password:</label>
                    <input class="form-control" type="password" name="password" required id="password" placeholder="Your Password">

                    <label for="email">Email:</label>
                    <input class="form-control" type="email" name="email"  placeholder="Your email">

                    <input class="btn btn-primary" type="submit" name="create" value="Sign Up">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
