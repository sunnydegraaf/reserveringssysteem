<?php
include_once("includes/database.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Afspraak formulier</title>
</head>
<body onload="show_selected()">
<div class="container">
    <div class="formulier">
        <h1>Afspraak inplannen</h1>
        <form action="appointments-confirm.php" method="post">
            <div>
                <input class="half-width" type="text" name="fname" placeholder="voornaam" required>
                <input class="half-width" type="text" name="lname" placeholder="achternaam" required>
            </div>
            <div>
                <input class="half-width" type="email" name="email" placeholder="email" required>
                <input class="half-width" type="tel" name="tel" placeholder="telefoonnummer" required>
            </div>
            <input id="aantal" type="number" name="qty" min="1" max="5" value="1">
            <select name="id" id="diensten">
                <?php foreach ($services as $i => $service) { ?>
                    <option id="<?=$service['id']?>" value="<?=$service['id']?>">
                        <?= $service['name']; ?> (<?= $service['duration']; ?>  min)
                    </option>

                <?php } ?>
            </select>
            <div class="data-field">
                <input type="text" name="date" id="date" placeholder="Selecteer een datum" readonly="readonly"/>
                <span class="errors"><?= isset($errors['date']) ? $errors['date'] : '' ?></span>
            </div>
            <div class="data-field">
                <select name="time" id="time">
                    <option value="">Selecteer eerst een datum</option>
                </select>
                <span class="errors"><?= isset($errors['time']) ? $errors['time'] : '' ?></span>
            </div>
            <div class="test">
                <div class="price">
                    <input class="button" name="submit" type="submit">
                </div>
            </div>
        </form>
    </div>
    <div class="informatie">
        <img id="cover" src="images/wie-ben-ik.jpg">
        <div class="prijslijst">
            <h1>Prijslijst</h1>
            <table class="prijstabel">
                <tr>
                    <th>Dienst</th>
                    <th>Prijs</th>
                    <th>Tijd</th>
                </tr>
                <?php foreach ($services as $i => $service) { ?>
                    <tr>
                        <td><?= $service['name']?></td>
                        <td>&euro;<?= $service['price']?>,-</td>
                        <td><?= $service['duration']?> min.</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', function() {
        let selector = document.getElementById('diensten');
        selector.addEventListener('change', onChange)

        function onChange(e) {
            let optionElement = e.target;
            let amount = optionElement[selector.selectedIndex].value;
            document.getElementById('price').innerHTML = amount;
        }
    })
</script>

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="includes/main.js"></script>
<script>
    $( function() {
        $( "#date" ).datepicker({ minDate: 0});
    } );

    $(function() {
        $('#date').datepicker({
            beforeShowDay: $.datepicker.noWeekends
        });
    });
</script>

</body>
</html>