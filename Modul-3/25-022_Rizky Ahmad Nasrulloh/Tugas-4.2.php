<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");
$keys = array_keys($weight); // Mengambil kunci (nama) ke dalam array terindeks
$length = count($keys);

for($i = 0; $i < $length; $i++) {
    $name = $keys[$i];
    $w = $weight[$name];
    echo $name . " is " . $w . " kg.<br>";
}
?>