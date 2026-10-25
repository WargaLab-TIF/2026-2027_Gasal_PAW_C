<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posted Data</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 2em; }
        h3 { margin-bottom: 0.5em; }
        .note { color: #555; font-style: italic; }
    </style>
</head>
<body>
<h3>Posted data: </h3>
<?php
if (empty($_POST)) {
    echo '<p class="note">Tidak ada data POST yang diterima.</p>';
} else {
    foreach ($_POST as $key => $value) {
        $safe_key = htmlspecialchars((string) $key, ENT_QUOTES, 'UTF-8');
        if (is_array($value)) {
            $safe_value = htmlspecialchars(implode(', ', $value), ENT_QUOTES, 'UTF-8');
        } else {
            $safe_value = htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
        }
        echo "($safe_key) => ($safe_value)<br/>";
    }
}

?>
</body>
</html>
