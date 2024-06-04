<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>User Registration | PHP</title>

    <!-- For local/offline use: <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.rtl.min.css">
    -->
    <!-- For online use: -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>
<body>
<div>
    <?php
    if(isset($_POST['create'])){
        echo "user submitted";
    }

        ?>

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
                    <input class="form-control" type="email" name="email" required id="email" placeholder="Your email">

                    <input class="brn btn-primary" type="submit" name="create" value="Sign Up" class="btn btn-primary mt-2">
                </form>
            </div>
        </div>
    </div>
</html>
