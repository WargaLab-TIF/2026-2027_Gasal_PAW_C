<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Validasi Server-side</title>
</head>
<body>
    <h3>Posted data:</h3>
    <?php
    require 'validate.inc';

    $errors = array();
    validateName($errors, $_POST, 'surname');

    if ($errors) {
        echo '<p><strong>Errors:</strong></p>';
        foreach ($errors as $field => $error) {
            echo htmlspecialchars($field) . ' ' . htmlspecialchars($error) . '<br/>';
        }
    } else {
        echo '<p>Data OK!</p>';
    }

    echo '<hr>';

    foreach ($_POST as $key => $value) {
        if (is_array($value)) {
            $value = implode(', ', $value);
        }
        echo '(' . htmlspecialchars($key) . ') =&gt; ('
            . htmlspecialchars($value) . ')<br>';
    }
    ?>
</body>
</html>
