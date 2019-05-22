<?php
session_start();

//Can I visit this page?
if (!isset($_SESSION['login'])) {
    header("location: login.php");
    exit;
}

$email = $_SESSION['login'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <title>Hele belangrijke informatie</title>
</head>
<body>
<div class="blocks">
    <h1>Welkom!</h1>
    <p>U bent ingelogd als <?= $email ?></p>
    <div class="buttons">
        <form action="logout.php">
            <input class="button-grey" type="submit" name="logout" value="Logout"/>
        </form>
        <form action="afspraakoverzicht.php">
            <input class="button" type="submit" name="logout" value="Afsrpaakoverzicht"/>
        </form>
    </div>
</div>
</body>
</html>