<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";
echo print_r($fruits);
echo "<br>";
echo "Nilai dengan indeks tertinggi adalah : ", $fruits[count($fruits) - 1];
?>