<?php
//Tambahkan lima data baru ke dalam array $height, lalu tampilkan nilai dengan indeks terakhir. Setelah itu, hapus satu data tertentu dan tampilkan kembali nilai dengan indeks terakhir!

$height = array("Andy"=>"176","Barry"=>"165","Charlie"=>"170");
// echo "Andy is " . $height['Andy'] ." cm tall.";

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = ";
var_dump ($height);
echo "<br>";

echo "Nilai dengan indeks terakhir : ";
echo $height["Harry"];

unset($height["Barry"]);
echo "<br>";
echo "<br>";

echo "height = ";
var_dump ($height);
echo "<br>";

echo "Nilai dengan indeks terakhir setelah dihapus: ";
echo $height["Harry"];
?>