<?php
echo "<h3>Posted data:</h3>";

foreach ($_GET as $key => $value) {
    echo "(" . $key . ") => (" . $value . ")<br>";
}
?>