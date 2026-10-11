<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

// Menambahkan 5 data baru
array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

echo "fruits = (\"" . implode("\", \"", $fruits) . "\")<br>";

// Menampilkan nilai dengan indeks tertinggi (indeks terakhir)
$highestIndex = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$highestIndex] . "<br>";
?> 