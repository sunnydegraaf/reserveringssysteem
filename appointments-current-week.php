<?php
//Require DB settings with connection variable
require_once "includes/database.php";

//Get the result set from the database with a SQL query
$query = "SELECT * 
          FROM appointments 
          WHERE YEARWEEK(`date`, 1) = YEARWEEK(CURDATE(), 1) ORDER BY `date` DESC, time ASC";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array
$appointments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = $row;
}

//Close connection
mysqli_close($db);
?>

<!doctype html>
<html>
<head>
    <title>Afspraak overzicht</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css"/>
    <link rel="stylesheet" type="text/css" href="includes/nav.css"/>

</head>
<body>
<div class="blocks">
<div class="nav">
    <h1>Afspraak overzicht</h1>
    <label for="toggle">&#9776;</label>
    <input type="checkbox" id="toggle"/>
    <div class="menu">
        <a href="appointments.php">Afspraak overzicht</a>
        <a href="add-appointment.php">Afspraak maken</a>
        <a href="services.php">Diensten overzicht</a>
        <a href="add-service.php">Dienst toevoegen</a>
        <a href="#">Werktijden</a>
        <a href="logout.php">Logout</a>
    </div>
</div>
<div>
    <ul  class="sub-menu">
        <li class="th-title"><a href="appointments-current-week.php">Week</a>&darr;</li>
        <li class="th-title"><a href="appointments-current-month.php">Maand</a></li>
    </ul>
</div>
<table cellspacing="0" cellpadding="0" class="overzicht">
    <thead>
    <tr class="titles">
        <th class="th-title"><a href="appointments-fname.php">Voornaam</a></th>
        <th class="th-title"><a href="appointments-lname.php">Achternaam</a></th>
        <th class="th-title"><a href="">Email</a></th>
        <th class="th-title"><a href="appointments-tel.php">Telefoonnummer</a></th>
        <th class="th-title"><a href="appointments-date-desc.php">Datum</a></th>
        <th class="th-title"><a href="">Start</a></th>
        <th class="th-title"><a href="">Eind</a></th>
        <th class="th-title"><a href="">Dienst</a></th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($appointments as $i => $appointment) { ?>
        <?php
        //Use the 'modulus' check to define a odd/even class for the table rows
        $rowClass = 'odd';
        if ($i % 2 > 0) {
            $rowClass = 'even';
        }
        ?>
        <tr class="<?= $rowClass; ?>">
            <td><?= $appointment['fname']; ?></td>
            <td><?= $appointment['lname']; ?></td>
            <td><?= $appointment['email']; ?></td>
            <td><?= $appointment['tel']; ?></td>
            <td><?= date("d/m/Y", strtotime($appointment['date'])); ?></td>
            <td><?= date('H:i', strtotime($appointment['time'])); ?></td>
            <td><?= date('H:i', strtotime($appointment['end'])) ?></td>
            <td><?= $appointment['service']; ?></td>
            <td><a href="edit-appointment.php?id=<?= $appointment['id']; ?>">Aanpassen</a></td>
            <td><a href="delete-appointment.php?id=<?= $appointment['id']; ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<div>
</body>
</html>
