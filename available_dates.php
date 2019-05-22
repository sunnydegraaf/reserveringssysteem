<?php
require_once "includes/database.php";

$times = [];
$time = strtotime('09:00');
while($time <= strtotime('17:00')) {

    $times[] = date('H:i', $time);
    $time += 60 * 15;
}

$date = mysqli_escape_string($db, $_GET['date']);

$query = "SELECT *
          FROM appointments
          WHERE date = '$date'";

$result = $db->query($query);

if ($result) {
    $reservations = [];
    while($row = mysqli_fetch_assoc($result)) {
        $reservations[] = $row;
    }
}

$availableTimes = [];
foreach ($times as $time)
{
    $occurs = false;
    $time = strtotime($time);
    foreach ($reservations as $reservation)
    {
        $reservationStart = strtotime($reservation['time']);
        if($time >=  $reservationStart && $time <  strtotime($reservation['end'])) {
            $occurs = true;
        }
    }

    if(!$occurs) {
        $availableTimes[] = date('H:i', $time);
    }
}

header("Content-type: application/json");
echo json_encode($availableTimes);
exit;