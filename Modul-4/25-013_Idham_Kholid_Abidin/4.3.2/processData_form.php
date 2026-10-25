<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Self Submission</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 2em;
            background-color: #f7f7f7;
            color: #222;
        }
        h2 {
            margin-bottom: 0.5em;
        }
        h1 {
            font-size: 1.2em;
            color: #a40000;
        }
        fieldset {
            border: 1px solid #bbb;
            padding: 1em 1.5em;
            max-width: 32em;
            background-color: #fff;
        }
        legend {
            font-weight: bold;
            padding: 0 0.4em;
        }
        .field {
            margin-bottom: 0.8em;
        }
        .field label {
            display: inline-block;
            width: 11em;
            vertical-align: top;
            font-weight: bold;
        }
        .field input[type="text"],
        .field input[type="password"],
        .field textarea,
        .field select {
            padding: 0.2em;
            border: 1px solid #999;
            border-radius: 3px;
        }
        .field .choice {
            display: inline-block;
            margin-right: 1em;
            font-weight: normal;
            width: auto;
        }
        .field input[type="submit"],
        .field input[type="reset"] {
            padding: 0.3em 1em;
        }
        .error {
            color: #a40000;
            font-size: 0.9em;
            margin-left: 0.5em;
        }
        .success {
            color: #006400;
            font-weight: bold;
        }
    </style>
</head>
<body>
<h2>Register</h2>
<?php
require 'validate.inc';
$errors = array();

if (isset($_POST['submit'])) {
    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validatePassword($errors, $_POST, 'passwd');
    validateAddress($errors, $_POST, 'address');
    validateState($errors, $_POST, 'state');
    validateSex($errors, $_POST, 'sex');

    if ($errors) {
        echo '<h1>Invalid, correct the following errors:</h1>';
        foreach ($errors as $field => $error) {
            echo htmlspecialchars($field, ENT_QUOTES, 'UTF-8') . ' '
                . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '<br/>';
        }
        include 'form.inc';   // form ditampilkan lagi DENGAN isian sebelumnya
    } else {
        echo '<p class="success">Form submitted successfully with no errors!</p>';
    }
} else {
    include 'form.inc';       // form kosong
}
?>
</body>
</html>
