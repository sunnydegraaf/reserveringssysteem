<?php
include_once("includes/database.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $queryAll = "DELETE FROM appointments WHERE id = $id";
    $result = mysqli_query($db, $queryAll) or die ("FAILED" .mysqli_error());

} else {
    header("Location: appointments.php");
}

//Redirect to homepage after deletion & exit script
header("Location: appointments.php");
exit;
