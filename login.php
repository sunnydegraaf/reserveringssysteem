<?php
session_start();
//Require database in this file
require_once "includes/database.php";

//Check if user is logged in, else move to secure page
if (isset($_SESSION['loggedInUser'])) {
    header("Location: appointments.php");
    exit;
}

//If form is posted, lets validate!
if (isset($_POST['submit'])) {
    //Retrieve values (email safe for query)
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];

    //Get password & name from DB
    $query = "SELECT id, email, password FROM users
              WHERE email = '$email'";
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);

    //Check if email exists in database
    $errors = [];
    if ($user) {
        //Validate password
        if (password_verify($password, $user['password'])) {
            //Set email for later use in Session
            $_SESSION['loggedInUser'] = [
                'name' => $user['name'],
                'id' => $user['id']
            ];

            //Redirect to secure.php & exit script
            header("Location: secure.php");
            exit;
        } else {
            $errors[] = 'Uw wachtwoord is onjuist';
        }
    } else {
        $errors[] = 'Uw email komt niet voor in de database';
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <title>Login</title>
</head>
<body>
<div class="blocks blocks-padding">
    <h1>Login</h1>
    <?php if (isset($errors) && !empty($errors)) { ?>
        <ul class="errors">
            <?php for ($i = 0; $i < count($errors); $i++) { ?>
                <li><?= $errors[$i]; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
        <div>
            <input class="full-width" type="email" name="email" placeholder="email" value="<?= (isset($email) ? $email : ''); ?>"/>
        </div>
        <div>
            <input class="full-width" type="password" name="password" placeholder="wachtwoord"/>
        </div>
        <div>
            <input class="button" type="submit" name="submit" value="Login"/>
        </div>
    </form>
</div>
</body>
</html>
