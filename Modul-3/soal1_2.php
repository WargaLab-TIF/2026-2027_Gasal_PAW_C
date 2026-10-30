<?php 

//Hapus satu data tertentu dari array $fruits! Tampilkan nilai dengan indeks tertinggi dari array $fruits!

$s = "<br>";

$fruits = array("Avocado","Blueberry","Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew");
echo "Array awal : " . $s . "fruits = ";
var_dump($fruits);
echo $s;

$hapus = $fruits[1];
unset($fruits[1]);
echo $s . "Data $hapus dihapus" . $s . $s;

$fruits = array_values($fruits);
echo "Array hasil : " . $s . "fruits = ";
var_dump($fruits);
echo $s;

$akhir = count($fruits)-1;
echo "Nilai dengan indeks tertinggi : " . $fruits[$akhir];
 ?>