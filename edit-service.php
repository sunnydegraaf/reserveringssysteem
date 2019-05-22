<?php
//Require music data to use variable in this file
require_once "includes/database.php";

if (isset($_POST['submit'])) {
$serviceId  = mysqli_real_escape_string($db, $_POST['id']);
$name       = mysqli_real_escape_string($db, $_POST['name']);
$duration   = mysqli_real_escape_string($db, $_POST['duration']);
$price      = mysqli_real_escape_string($db, $_POST['price']);

    //Require the form validation handling
    require_once "includes/validation-services.php";

    //Save variables to array so the form won't break
    $service = [
        'name'      => $name,
        'duration'  => $duration,
        'price'     => $price,
    ];

    if (empty($errors)) {

        //Update the record in the database
        $query = "UPDATE  services 
                  SET     name = '$name', 
                          duration = '$duration', 
                          price = '$price' 
                  WHERE   id = '$serviceId'";
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
    $serviceId = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM services WHERE id = " . mysqli_escape_string($db, $serviceId);
    $result = mysqli_query($db, $query);
    $service = mysqli_fetch_assoc($result);
}

//Close connection
mysqli_close($db);
?>

<!doctype html>
<html>
<head>
    <title>Dienst wijzigen</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css"/>
</head>
<body>
<div class="blocks blocks-padding">
    <h1>Dienst <?= htmlentities($service['name']); ?></h1>

    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
        <div>
            <input class="full-width" id="name" type="text" name="name" placeholder="dienst" value="<?= htmlentities($service['name']); ?>"/>
        </div>
        <div class="data-field">
            <input class="full-width" id="duration" type="text" name="duration" placeholder="tijdsduur" value="<?= htmlentities($service['duration']); ?>"/>
        </div>
        <div class="data-field">
            <input class="full-width" id="price" type="text" name="price" placeholder="prijs" value="<?= htmlentities($service['price']); ?>"/>
        </div>
        <div class="data-submit">
            <input type="hidden" name="id" value="<?= $serviceId; ?>"/>
            <input class="button" type="submit" name="submit" value="Save"/>
        </div>
    </form>
    <div>
        <a href="services.php">Go back to the list</a>
    </div>
</div>
</body>
</html>
