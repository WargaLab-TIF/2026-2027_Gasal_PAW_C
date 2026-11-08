<?php
echo "<h3>Data Pengguna:</h3>";

foreach ($_POST as $key => $value) {
    echo "(" . htmlspecialchars($key) . ") => (" . htmlspecialchars($value) . ")<br>";
}
?>