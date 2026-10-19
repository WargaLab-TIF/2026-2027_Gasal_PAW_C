<?php
$fruits = array("Avocado", "Blueberry", "Cherry", "Durian",
"Elderberry", "Fig", "Grape", "Honeydew"
);

$nilai_tertinggi = max($fruits);
echo "Nilai dengan indeks tertinggi: " . $nilai_tertinggi;

echo "<br>";

$hapus = $fruits[2];
echo "Data " . $hapus . " dihapus.<br>";

unset($fruits[2]);
$fruits = array_values($fruits);

echo 'fruits = ( "' . implode('", "', $fruits) . '" )<br>';

$nilai_tertinggi = max($fruits);
echo "Nilai dengan indeks tertinggi: " . $nilai_tertinggi;
?>