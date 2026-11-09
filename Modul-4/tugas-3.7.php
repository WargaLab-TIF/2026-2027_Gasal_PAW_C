<?php
require_once 'validate.inc';

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    validateName($errors, $_POST, 'surname');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas-3.7</title>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($errors) {
            echo '<b>Invalid, correct the following errors:</b><br>';
            foreach ($errors as $field => $error) {
                echo "$field $error<br>";
            }
            echo '<br>';

            require_once 'form.inc';
        } else {
            echo '<b>Form submitted successfully with no errors!</b>';
        }
    } else {
        require_once 'form.inc';
    }
    ?>
</body>
</html>