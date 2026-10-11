<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

// 1.1 : tampilkan isi array dengan memanggil index satu per satu
echo "fruits = ( \"" . $fruits[0] . "\", \"" . $fruits[1] . "\", \"" . $fruits[2] . "\", \"" . $fruits[3] . "\", \"" . $fruits[4] . "\", \"" . $fruits[5] . "\", \"" . $fruits[6] . "\", \"" . $fruits[7] . "\")<br>";
echo "Nilai dengan indeks tertinggi: " . $fruits[count($fruits) - 1] . "<br><br>";

// 1.2 : hapus Blueberry (index 1), lalu rapikan index
echo "Data " . $fruits[1] . " dihapus.<br>";
unset($fruits[1]);
$fruits = array_values($fruits);

echo "fruits = ( \"" . $fruits[0] . "\", \"" . $fruits[1] . "\", \"" . $fruits[2] . "\", \"" . $fruits[3] . "\", \"" . $fruits[4] . "\", \"" . $fruits[5] . "\", \"" . $fruits[6] . "\")<br>";
echo "Nilai dengan indeks tertinggi: " . $fruits[count($fruits) - 1] . "<br>";
?>
