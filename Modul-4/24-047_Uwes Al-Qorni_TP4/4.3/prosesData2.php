<!DOCTYPE html>
<html>
<head>
    <title>Process Data</title>
</head>
<body>

<h3>Posted data:</h3>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    foreach ($_POST as $key => $value) {
        echo "(" . htmlspecialchars($key) . ") => ("
            . htmlspecialchars($value) . ")<br>";
    }

} else {
    echo "Silakan isi form terlebih dahulu.";
}
?>

</body>
</html>
