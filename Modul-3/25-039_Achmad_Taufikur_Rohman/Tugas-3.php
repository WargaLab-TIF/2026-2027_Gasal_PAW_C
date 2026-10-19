<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
echo "Andy is" . $height['Andy'] . "cm tall";
echo "<br>";
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
echo implode(", ", $items) . ")<br>";

echo "Nilai dengan indeks terakhir: " . end($height) . "<br><br>";

unset($height["Frank"]);

echo "height = (";
$items = [];
foreach ($height as $key => $value) {
    $items[] = "\"$key\"=>\"$value\"";
}
echo implode(", ", $items) . ")<br>";

echo "Nilai dengan indeks terakhir setelah dihapus: " . end($height);

echo "<br>";
echo "<br>";
echo "<br>";
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

echo "weight = (";
$items = [];
foreach ($weight as $key => $value) {
    $items[] = "\"$key\"=>\"$value\"";
}
echo implode(", ", $items) . ")<br>";

$keys = array_keys($weight);
echo "Data kedua: " . $weight[$keys[1]];
?>