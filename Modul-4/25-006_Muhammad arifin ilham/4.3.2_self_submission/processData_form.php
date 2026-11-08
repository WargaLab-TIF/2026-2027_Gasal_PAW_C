<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1></h1>
<?php
$errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_POST['surname'])) {
    require 'validate.inc';
    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validateState($errors, $_POST, 'state');

    if ($errors) {
        echo '<h1>Invalid, correct the following errors:</h1>';
        foreach ($errors as $field => $error) {
            echo "$field $error<br/>";
        }
        include 'form.inc';
    } else {
        echo 'Form submitted successfully with no errors';
    }
} else {
    include 'form.inc';
}
?>
</body>
</html>