<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

// Menambah 5 data
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = (";
$temp = [];
foreach($height as $k => $v) { $temp[] = "\"$k\"=>\"$v\""; }
echo implode(", ", $temp) . ")<br>";

// Menampilkan nilai dengan indeks terakhir
$LastValue = end($height);
echo "Nilai dengan indeks terakhir: " . $LastValue . "<br>";

// Menghapus data Barry
unset($height["Barry"]);

echo "height = (";
$temp = [];
foreach($height as $k => $v) { $temp[] = "\"$k\"=>\"$v\""; }
echo implode(", ", $temp) . ")<br>";

$LastValue = end($height);
echo "Nilai dengan indeks terakhir setelah dihapus: " . $LastValue . "<br>";
?> 