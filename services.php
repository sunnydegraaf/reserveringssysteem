<?php
//Require DB settings with connection variable
require_once "includes/database.php";

//Get the result set from the database with a SQL query
$query = "SELECT * 
          FROM services";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array
$services = [];
while ($row = mysqli_fetch_assoc($result)) {
    $services[] = $row;
}

//Close connection
mysqli_close($db);
?>

<!doctype html>
<html>
<head>
    <title>Diensten overzicht</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css"/>
    <link rel="stylesheet" type="text/css" href="includes/nav.css"/>

</head>
<body>
<div class="blocks">
<div class="nav">
    <h1>Diensten overzicht</h1>
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
<table cellspacing="0" cellpadding="0" class="overzicht">
    <thead>
    <tr class="titles">
        <th class="th-title"><a href="">Naam</a></th>
        <th class="th-title"><a href="">Duur</a></th>
        <th class="th-title"><a href="">Prijs</a></th>
        <th class="th-title"><a href="">Aanpassen</a></th>
        <th class="th-title"><a href="">Delete</a></th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($services as $i => $service) { ?>
        <?php
        //Use the 'modulus' check to define a odd/even class for the table rows
        $rowClass = 'odd';
        if ($i % 2 > 0) {
            $rowClass = 'even';
        }
        ?>
        <tr class="<?= $rowClass; ?>">
            <td><?= $service['name']; ?></td>
            <td><?= $service['duration']; ?> min.</td>
            <td>&euro;<?= $service['price']; ?>,-</td>
            <td><a href="edit-service.php?id=<?= $service['id']; ?>">Aanpassen</a></td>
            <td><a href="delete-service.php?id=<?= $service['id']; ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
</body>
</html>
