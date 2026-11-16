<?php
require 'validate.inc'; $errors
= array();
validateName($errors, $_POST, 'surname'); if
($errors)
{
 echo 'Errors:<br/>';
 foreach ($errors as $field => $error)
echo "$field $error</br>";
} else
 echo 'Data OK!';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posted Data</title>
</head>
<body>
    <h1>Posted data:</h1>
    <div class="result">
        <?php foreach ($_POST as $key => $value): ?>
            <div class="row">
                <span class="key">(<?= $key; ?>)</span>
                <?=$value; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <p><a href="processData_form.html">Kembali ke form</a></p>
</body>
</html>