<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");
// Mengambil data kedua menggunakan fungsi array_values
$values = array_values($weight);
echo "Data kedua: " . $values[1] . "<br>";
?>