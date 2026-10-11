<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

// Mendapatkan semua key
$keys = array_keys($weight);
$length = count($keys);

for($i = 0; $i < $length; $i++) {
    $name = $keys[$i];
    $w = $weight[$name];
    echo $name . " is " . $w . " kg.<br>";
}
?> 