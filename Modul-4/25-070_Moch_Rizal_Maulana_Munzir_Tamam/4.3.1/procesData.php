<?php
require_once 'validate.inc';

$errors = [];
validateName($errors, $_POST, 'surname');

if (!empty($errors)) {
    echo "<h3 style='color:red;'>Data Invalid!</h3>";
    foreach ($errors as $field => $error) {
        echo "Field <b>$field</b> : $error<br>";
    }
} else {
    echo "<h3>Data Pengguna:</h3>";
    foreach ($_POST as $key => $value) {
        echo "(" . htmlspecialchars($key) . ") => (" . htmlspecialchars($value) . ")<br>";
    }
}
?>
