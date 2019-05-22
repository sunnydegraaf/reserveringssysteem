<?php
//Require music data to use variable in this file
require_once "includes/database.php";

if (isset($_POST['submit'])) {

$appointmentId  = mysqli_real_escape_string($db, $_POST['id']);
$fname          = mysqli_real_escape_string($db, $_POST['fname']);
$lname          = mysqli_real_escape_string($db, $_POST['lname']);
$email          = mysqli_real_escape_string($db, $_POST['email']);
$tel            = mysqli_real_escape_string($db, $_POST['tel']);

    //Require the form validation handling
    require_once "includes/validation-edit.php";

    //Save variables to array so the form won't break
    $appointment = [
        'fname'    => $fname,
        'lname'    => $lname,
        'email'    => $email,
        'tel'      => $tel,
    ];

    if (empty($errors)) {

        //Update the record in the database
        $query = "UPDATE  appointments 
                  SET     fname =   '$fname', 
                          lname =   '$lname', 
                          tel =     '$tel', 
                          email =   '$email' 
                  WHERE   id =      '$appointmentId'";
        $result = mysqli_query($db, $query);

        if ($result) {
            //Set success message
            $success = true;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }
    }

} else {
    //Retrieve the GET parameter from the 'Super global'
    $appointmentId = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM appointments WHERE id = " . mysqli_escape_string($db, $appointmentId);
    $result = mysqli_query($db, $query);
    $appointment = mysqli_fetch_assoc($result);
}

//Close connection
mysqli_close($db);
?>

<!doctype html>
<html>
<head>
    <title>Afspraak wijzigen</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css"/>
</head>
<body>
<div class="blocks blocks-padding">
    <h1>Afspraak <?= htmlentities($appointment['fname']); ?> <?= htmlentities($appointment['lname']); ?></h1>

    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
        <div>
            <input class="full-width" id="fname" type="text" name="fname" placeholder="voornaam" value="<?= htmlentities($appointment['fname']); ?>"/>
        </div>
        <div class="data-field">
            <input class="full-width" id="lname" type="text" name="lname" placeholder="achternaam" value="<?= htmlentities($appointment['lname']); ?>"/>
        </div>
        <div class="data-field">
            <input class="full-width" id="email" type="text" name="email" placeholder="email" value="<?= htmlentities($appointment['email']); ?>"/>
        </div>
        <div class="data-field">
            <input class="full-width" id="tel" type="text" name="tel" placeholder="telefoon" value="<?= htmlentities($appointment['tel']); ?>"/>
        </div>
        <div class="data-submit">
            <input type="hidden" name="id" value="<?= $appointmentId; ?>"/>
            <input class="button" type="submit" name="submit" value="Save"/>
        </div>
    </form>
    <div>
        <a href="appointments.php">Go back to the list</a>
    </div>
</div>
</body>
</html>
