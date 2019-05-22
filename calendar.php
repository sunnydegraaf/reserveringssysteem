<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery UI Datepicker - Restrict date range</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#date" ).datepicker({ minDate: 0, maxDate: "+1M" });
        } );
    </script>
</head>
<body>
<form>
    <div class="data-field">
        <input name="date" type="date" id="date">
        <span class="errors"><?= isset($errors['date']) ? $errors['date'] : '' ?></span>
    </div>
</form>
</body>
</html>