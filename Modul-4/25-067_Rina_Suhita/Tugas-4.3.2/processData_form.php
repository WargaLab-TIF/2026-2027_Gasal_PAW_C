<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <style>
    body { font-family: Arial, sans-serif; }
    fieldset { background: #ddddff; width: 420px; }
    .field { margin-bottom: 6px; }
    .field label { display: inline-block; width: 110px; text-align: right; vertical-align: top; margin-right: 6px; }
    .error { color: #c00; }
  </style>
</head>
<body>
<h1>Register</h1>
<?php
$errors = array();

if (isset($_POST['surname']))
{
    require 'validate.inc';

    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validatePassword($errors, $_POST, 'passwd');
    validateAddress($errors, $_POST, 'address');
    validateState($errors, $_POST, 'state');
    validateGender($errors, $_POST, 'sex');

    if ($errors)
    {
        echo '<h2 class="error">Invalid, correct the following errors:</h2>';
        foreach ($errors as $field => $error)
            echo "$field $error</br>";

        // tampilkan kembali form (dengan isian data)
        echo '<fieldset><legend>Person Details</legend>';
        include 'form.inc';
        echo '</fieldset>';
    }
    else
    {
        echo 'Form submitted successfully with no errors';
    }
}
else
{
    // tampilkan form kosong
    echo '<fieldset><legend>Person Details</legend>';
    include 'form.inc';
    echo '</fieldset>';
}
?>
</body>
</html>