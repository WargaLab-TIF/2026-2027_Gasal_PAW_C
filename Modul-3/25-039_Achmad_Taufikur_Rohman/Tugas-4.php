<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = (";
$items = [];
foreach ($height as $key => $value) {
    $items[] = "\"$key\"=>\"$value\"";
}
echo implode(", ", $items) . ")<br><br>";

foreach ($height as $nama => $tinggi) {
    echo "$nama is $tinggi cm tall.<br>";
}

echo "<br>";
echo "<br>";
echo "<br>";
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

echo "weight = (";
$items = [];
foreach ($weight as $key => $value) {
    $items[] = "\"$key\"=>\"$value\"";
}
echo implode(", ", $items) . ")<br><br>";

$keys = array_keys($weight);
$jumlah = count($weight);

for ($i = 0; $i < $jumlah; $i++) {
    $nama = $keys[$i];
    echo "$nama is " . $weight[$nama] . " kg.<br>";
}
?>