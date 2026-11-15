<?php
function tampilArray($nama, $arr) {
    $item = array();
    foreach ($arr as $v) {
        $item[] = '"' . $v . '"';
    }
    echo $nama . " = ( " . implode(", ", $item) . ")<br>";
}

$fruits = array("Avocado", "Blueberry", "Cherry");

// 1.1 Menambahkan lima data baru, lalu tampilkan nilai dengan indeks tertinggi
$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

tampilArray("fruits", $fruits);
echo "Nilai dengan indeks tertinggi: " . $fruits[array_key_last($fruits)] . "<br>";

echo "<br>";

// 1.2 Menghapus satu data tertentu (Blueberry, indeks 1), lalu tampilkan nilai dengan indeks tertinggi
unset($fruits[1]);

echo "Data Blueberry dihapus.<br>";
tampilArray("fruits", $fruits);
echo "Nilai dengan indeks tertinggi: " . $fruits[array_key_last($fruits)] . "<br>";
?>