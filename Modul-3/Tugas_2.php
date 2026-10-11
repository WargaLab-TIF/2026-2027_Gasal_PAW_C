<?php
$fruits = array("Avocado", "Blueberry", "Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

// Menghapus data "Blueberry" (indeks ke-1)
unset($fruits[1]);
// Re-index array agar urutannya kembali rapi
$fruits = array_values($fruits); 

echo "Data Blueberry dihapus.<br>";
echo "fruits = (\"" . implode("\", \"", $fruits) . "\")<br>";

// Menampilkan nilai dengan indeks tertinggi
$highestIndex = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$highestIndex] . "<br>";
?>