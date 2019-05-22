<?php
include_once('includes/database.php');

if (isset($_POST['submit'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $emailTo = $_POST['email'];
    $tel = $_POST['tel'];
    $id = $_POST['id'];
    $emailFrom = "sunny@mar-mer.nl";
    $message = "Hoi " . $fname . "\n" . "Ik zie je graag binnenkort voor " .
    $header = "Van :" . $emailFrom;

    //mail($emailTo, $onderwerp, $bericht, $header);
    //header("Location: index.php?mailsend");

    $quantity = $_POST['qty'];
    $date = date("Y/m/d", strtotime($_POST['date']));

    $start = strtotime($_POST['time']);
    $duration = $services[$id]['duration'] * 60 * $quantity;
    $end = $start + $duration;

    $startTime = date("H:i:s", $start);
    $endTime = date("H:i:s", $end);

    $service = $services[$id]['name'];

    if (empty($errors))
    {

        //Sla afspraak op in database
        $query = "INSERT INTO appointments
                  (fname, lname, email, tel, date, time, end, service)
                  VALUES ('$fname', '$lname', '$emailTo', '$tel', '$date', '$startTime', '$endTime', '$service')";
        $result = mysqli_query($db, $query);

        //Voeg contact gegevens bij klantenbestand
        $query = "INSERT INTO customers
                  (fname, lname, email, tel)
                  VALUES ('$fname', '$lname', '$emailTo', '$tel')";
        $result = mysqli_query($db, $query);

        //Close connection
        mysqli_close($db);
    }

    if ($endTime > strtotime('17:00')) {
        echo 'Wij sluiten om 17:00';
    }
}

$date = date("d/m/Y", strtotime($_POST['date']));

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <title>Bevestiging</title>
</head>
<body>
<div class="container">
    <div class="formulier">
        <h1>Hallo <?= $fname . " " . $lname;?>,</h1>
        <p>Je hebt een reservering aangevraagd voor <?= $services[$id]['name']?>.
           De prijs is &euro;<?= $services[$id]['price'] ?>,-. Dit wordt later verrekend.
           We zien je graag <?= $date ?> van
            <?= date('H:i', strtotime($startTime)) ?> tot
            <?= date('H:i', strtotime($endTime)) ?>.
            We hebben een bevestigings mail verstuurd naar <?= $emailTo ?>.</p>
    </div>
    <div class="informatie">
        <img id="cover" src="images/wie-is-jade-keizer.jpg">
    </div>
</div>
</body>
</html>