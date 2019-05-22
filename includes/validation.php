<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($lname == "") {
    $errors[] = 'Vul een voornaam in';
}
if ($fname == "") {
    $errors[] = 'Vul een achternaam in';
}
if ($email == "") {
    $errors[] = 'Vul een email in';
}
if (!is_numeric($tel)) {
    $errors[] = 'Vul een telefoonnummer in';
}
if ($service == "") {
    $errors[] = 'Selecteer een dienst';
}