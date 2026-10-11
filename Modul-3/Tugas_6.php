<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

echo "weight = (";
$temp = [];
foreach($weight as $k => $v) { $temp[] = "\"$k\"=>\"$v\""; }
echo implode(", ", $temp) . ")<br>";

// Untuk mengambil data kedua pada array asosiatif
$keys = array_keys($weight);
$secondKey = $keys[1];
echo "Data kedua: " . $weight[$secondKey] . "<br>";
?>