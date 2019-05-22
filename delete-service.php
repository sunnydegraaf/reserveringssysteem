<?php
include_once("includes/database.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $queryAll = "DELETE FROM services WHERE id = $id";
    $result = mysqli_query($db, $queryAll) or die ("FAILED" .mysqli_error());

} else {
    header("Location: services.php");
}

//Redirect to homepage after deletion & exit script
header("Location: services.php");
exit;
