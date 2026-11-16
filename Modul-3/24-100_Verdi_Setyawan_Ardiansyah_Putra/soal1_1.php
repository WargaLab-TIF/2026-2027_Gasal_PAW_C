<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

$indeksTertinggi = count($fruits) - 1;

echo 'fruits = ("' . implode('", "', $fruits) . '")';
echo "<br>Nilai dengan indeks tertinggi: " . $fruits[$indeksTertinggi];
?>
