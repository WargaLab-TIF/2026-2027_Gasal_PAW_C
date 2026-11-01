<?php
$fruits = array("Avocado", "Blueberry", "Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

unset($fruits[1]);
echo "Data Blueberry dihapus.<br>";

echo 'fruits = ( "' . implode('", "', $fruits) . '")<br>';

$indeksTertinggi = array_key_last($fruits);
echo "Nilai dengan indeks tertinggi: " . $fruits[$indeksTertinggi];
?>