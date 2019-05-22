<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($naam == "") {
    $errors[] = 'Vul een dienst naam in';
}
if ($tijdsduur == "" || !is_numeric($tijdsduur)) {
    $errors[] = 'Vul een tijdsduur in';
}

if ($prijs == "" || !is_numeric($prijs)) {
    $errors[] = 'Vul een prijs in';
}

//if (is_numeric($prijs == "")) {
