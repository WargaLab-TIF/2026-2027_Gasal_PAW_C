<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

unset($fruits[1]);
$fruits = array_values($fruits);

$indeksTertinggi = count($fruits) - 1;

echo "Data Blueberry dihapus.<br>";
echo 'fruits = ("' . implode('", "', $fruits) . '")';
echo "<br>Nilai dengan indeks tertinggi: " . $fruits[$indeksTertinggi];
?>