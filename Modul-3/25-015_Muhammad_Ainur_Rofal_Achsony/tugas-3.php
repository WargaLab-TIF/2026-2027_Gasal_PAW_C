<?php
// 3.1 : tambah 5 data baru
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = (\"Andy\"=>\"" . $height["Andy"] . "\", \"Barry\"=>\"" . $height["Barry"] . "\", \"Charlie\"=>\"" . $height["Charlie"] . "\", \"David\"=>\"" . $height["David"] . "\", \"Ethan\"=>\"" . $height["Ethan"] . "\", \"Frank\"=>\"" . $height["Frank"] . "\", \"George\"=>\"" . $height["George"] . "\", \"Harry\"=>\"" . $height["Harry"] . "\")<br>";
echo "Nilai dengan indeks terakhir: " . $height["Harry"] . "<br><br>";

// hapus 1 data tertentu (Barry)
unset($height["Barry"]);

echo "height = (\"Andy\"=>\"" . $height["Andy"] . "\", \"Charlie\"=>\"" . $height["Charlie"] . "\", \"David\"=>\"" . $height["David"] . "\", \"Ethan\"=>\"" . $height["Ethan"] . "\", \"Frank\"=>\"" . $height["Frank"] . "\", \"George\"=>\"" . $height["George"] . "\", \"Harry\"=>\"" . $height["Harry"] . "\")<br>";
echo "Nilai dengan indeks terakhir setelah dihapus: " . $height["Harry"] . "<br><br>";

// 3.2 : array baru $weight isi 3 data, tampilkan data kedua (Barry)
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

echo "weight = (\"Andy\"=>\"" . $weight["Andy"] . "\", \"Barry\"=>\"" . $weight["Barry"] . "\", \"Charlie\"=>\"" . $weight["Charlie"] . "\")<br>";
echo "Data kedua: " . $weight["Barry"] . "<br>";
?>
