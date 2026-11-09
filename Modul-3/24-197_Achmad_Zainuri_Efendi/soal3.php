<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = (";
$out_h1 = [];
foreach($height as $k => $v) { $out_h1[] = "\"$k\"=>\"$v\""; }
echo implode(", ", $out_h1) . ")<br>";
echo "Nilai dengan indeks terakhir: " . end($height) . "<br><br>";

unset($height["Barry"]);

echo "height = (";
$out_h2 = [];
foreach($height as $k => $v) { $out_h2[] = "\"$k\"=>\"$v\""; }
echo implode(", ", $out_h2) . ")<br>";
echo "Nilai dengan indeks terakhir setelah dihapus: " . end($height) . "<br><br>";

$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

echo "weight = (";
$out_w = [];
foreach($weight as $k => $v) { $out_w[] = "\"$k\"=>\"$v\""; }
echo implode(", ", $out_w) . ")<br>";

$weight_values = array_values($weight);
echo "Data kedua: " . $weight_values[1] . "<br>";
?>