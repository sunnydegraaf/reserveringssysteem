<?php
$host = 'localhost';
$user = 'sunny';
$password = 'Aij7jxmj!';
$database = 'jade_keizer';

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());

$queryAll = "SELECT * FROM services";
$result = mysqli_query($db, $queryAll);

$services = [];
while($row = mysqli_fetch_assoc($result))
{
    $services[] = $row;
}

$queryAllTijden = "SELECT `tijd` FROM times";
$resultTijden = mysqli_query($db, $queryAllTijden);

$tijden = [];
while($row = mysqli_fetch_assoc($resultTijden))
{
    $tijden[] = $row;
}

$queryAllReserveringen = "SELECT * FROM appointments";
$resultReserveringen = mysqli_query($db, $queryAllReserveringen);

$reserveringen = [];
while($row = mysqli_fetch_assoc($resultReserveringen))
{
    $reserveringen[] = $row;
}
//mysqli_close($db);
?>