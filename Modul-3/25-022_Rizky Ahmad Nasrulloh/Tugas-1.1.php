<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
// Menambahkan 5 data baru
array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

echo 'fruits = ("' . implode('", "', $fruits) . '")<br>';
// Mengambil nilai indeks tertinggi (elemen terakhir)
echo "Nilai dengan indeks tertinggi: " . end($fruits) . "<br>";
?>