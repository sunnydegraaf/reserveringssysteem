<?php
include_once("includes/database.php");

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "includes/database.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $fname       = mysqli_real_escape_string($db, $_POST['fname']);
    $lname     = mysqli_escape_string($db, $_POST['lname']);
    $email          = mysqli_escape_string($db, $_POST['email']);
    $tel = mysqli_escape_string($db, $_POST['tel']);
    $date          = mysqli_escape_string($db, $_POST['date']);
    $time          = mysqli_escape_string($db, $_POST['time']);
    $service          = mysqli_escape_string($db, $_POST['service']);

    //Require the form validation handling
    require_once "includes/validation.php";

    if (empty($errors)) {

        //Sla afspraak op in databse
        $query = "INSERT INTO appointments
                  (fname, lname, email, tel, date, time, end, service)
                  VALUES ('$fname', '$lname', '$email', '$tel', '$date', '$time', '', '$service')";
        $result = mysqli_query($db, $query);

        if ($result) {
            //Set success message & empty all variables for new form
            $fname      = '';
            $lname      = '';
            $email      = '';
            $tel        = '';
            $date       = '';
            $time       = '';
            $end        = '';
            $service    = '';


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
    <title>Afspraak toevoegen</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
<div class="blocks blocks-padding">
    <h1>Afspraak toevoegen</h1>
    <?php if (isset($errors) && !empty($errors)) { ?>
        <ul class="errors">
            <?php for ($i = 0; $i < count($errors); $i++) { ?>
                <li><?= $errors[$i]; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <?php if (isset($success)) { ?>
        <p class="success">De afspraak is toegevoegd aan de planning</p>
    <?php } ?>

    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
        <div class="data-field">
            <input class="full-width" type="text" name="fname" placeholder="voornaam" value="<?= (isset($voornaam) ? $voornaam : ''); ?>"/>
        </div>
        <div class="data-field">
            <input class="full-width" type="text" name="lname" placeholder="achternaam" value="<?= (isset($achternaam) ? $achternaam : ''); ?>"/>
        </div>
        <div class="data-field">
            <input class="full-width" type="text" name="email" placeholder="email" value="<?= (isset($email) ? $email : ''); ?>"/>
        </div>
        <div class="data-field">
            <input class="full-width" type="text" name="tel" placeholder="telefoonnummer" value="<?= (isset($telefoonnummer) ? $telefoonnummer : ''); ?>"/>
        </div>
        <select name="service" id="diensten">
            <?php foreach ($services as $i => $service) { ?>
                <option class="full-width" id="<?=$service['id']?>" value="<?=$service['id']?>">
                    <?= $service['name']; ?> (<?= $service['duration']; ?>  min)
                </option>

            <?php } ?>
        </select>
        <div class="data-field">
            <input type="text" name="date" id="date" placeholder="Selecteer een datum" readonly="readonly"/>
            <span class="errors"><?= isset($errors['date']) ? $errors['date'] : '' ?></span>
        </div>
        <div class="data-field">
            <select name="time" id="time">
                <option value="">Selecteer eerst een datum</option>
            </select>
            <span class="errors"><?= isset($errors['time']) ? $errors['time'] : '' ?></span>
        </div>
        <div class="data-submit">
            <input class="button" type="submit" name="submit" value="Toevoegen"/>
        </div>
    </form>
    <div>
        <a href="appointments.php">Terug naar de planning</a>
    </div>
</div>

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="includes/main.js"></script>
<script>
    $( function() {
        $( "#date" ).datepicker({ minDate: 0});
    } );

    $(function() {
        $('#date').datepicker({
            beforeShowDay: $.datepicker.noWeekends
        });
    });
</script>

</body>
</html>
