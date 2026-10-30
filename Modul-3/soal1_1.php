<?php 

// Menambahkan lima data baru dalam array $fruits! Tampilkan nilai dengan indeks tertinggi dari array $fruits!

$s = "<br>";

$fruits = array("Avocado","Blueberry","Cherry");
echo "Array awal : " . $s . "fruits = ";
var_dump($fruits);
echo $s;

$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

echo "Array hasil : " . $s . "fruits = ";
var_dump($fruits);
echo $s;
$akhir = count($fruits)-1;

echo "Nilai dengan indeks tertinggi : " . $fruits[$akhir];

 ?>
