<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

echo "fruits = (\"" . implode("\", \"", $fruits) . "\")<br>";
echo "Nilai dengan indeks tertinggi: " . end($fruits) . "<br><br>";

$key = array_search("Blueberry", $fruits);
if ($key !== false) {
    unset($fruits[$key]);
    $fruits = array_values($fruits); 
}

echo "Data Blueberry dihapus.<br>";
echo "fruits = (\"" . implode("\", \"", $fruits) . "\")<br>";
echo "Nilai dengan indeks tertinggi: " . end($fruits) . "<br>";
?>
