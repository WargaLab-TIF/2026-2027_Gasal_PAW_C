<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Praktikum Modul 4</title>
</head>
<body style="background-color: brown; color: white;">
    <h1 style="text-align: center; background-color: grey;">Registrasi User</h1>

<?php
$errors =[];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'validate.inc';

    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validateRequired($errors, $_POST, 'password');
    validateRequired($errors, $_POST, 'address');

    if ($errors) {
        echo '<div style="background-color: yellow; color: red; padding: 10px; margin-bottom: 10px;">';
        echo '<h3>Invalid, correct the following errors:</h3>';
        foreach ($errors as $field => $error) {
            echo "<p><b>$field</b> : $error</p>";
        }
        echo '</div>';
        include 'form.inc';
    } else {
        echo '<div style="background-color: green; color: white; padding: 10px;">';
        echo '<h3>Registrasi succes tanpa ada error</h3>';
        echo '<h4>Data yang dikirim:</h4>';
        foreach ($_POST as $key => $value) {
            echo "<p>(" . htmlspecialchars($key) . ") => (" . htmlspecialchars($value) . ")</p>";
        }
        echo '</div>';
    }
}else {
    include 'form.inc';
}
?>

</body>
</html>