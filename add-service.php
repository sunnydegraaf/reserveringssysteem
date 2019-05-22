<?php
//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "includes/database.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $naam = mysqli_real_escape_string($db, $_POST['naam']);
    $tijdsduur = mysqli_escape_string($db, $_POST['tijdsduur']);
    $prijs = mysqli_escape_string($db, $_POST['prijs']);

    //Require the form validation handling
    require_once "includes/validation-appointment.php";


    if (empty($errors)) {

        //Sla afspraak op in databse
        $query = "INSERT INTO services
                  (name, duration, price)
                  VALUES ('$naam', '$tijdsduur', '$prijs')";
        $result = mysqli_query($db, $query);

        if ($result) {
            //Set success message & empty all variables for new form
            $naam = '';
            $tijdsduur = '';
            $prijs = '';
            $success = true;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

        //Close connection
        mysqli_close($db);
    }
}
?>
<!doctype html>
<html>
<head>
    <title>Dienst toevoegen</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css"/>
</head>
<body>
<div class="blocks blocks-padding">
    <h1>Dienst toevoegen</h1>
    <?php if (isset($errors) && !empty($errors)) { ?>
        <ul class="errors">
            <?php for ($i = 0; $i < count($errors); $i++) { ?>
                <li><?= $errors[$i]; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <?php if (isset($success)) { ?>
        <p class="success">De dienst is toegevoegd aan het overzicht</p>
    <?php } ?>

    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
        <div class="data-field">
            <input class="full-width" type="text" name="naam" placeholder="naam van dienst" value="<?= (isset($voornaam) ? $voornaam : ''); ?>"/>
        </div>
        <div class="data-field">
            <input class="full-width" type="text" name="tijdsduur" placeholder="tijdsduur" value="<?= (isset($achternaam) ? $achternaam : ''); ?>"/>
        </div>
        <div class="data-field">
            <input class="full-width" type="text" name="prijs" placeholder="prijs" value="<?= (isset($email) ? $email : ''); ?>"/>
        </div>
        <div class="data-submit">
            <input class="button" type="submit" name="submit" value="Toevoegen"/>
        </div>
    </form>
    <div>
        <a href="appointments.php">Terug naar de planning</a>
    </div>
</div>
</body>
</html>
