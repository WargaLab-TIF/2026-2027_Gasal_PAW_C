<?php
// tugas 1.1
$fruits = array("Avocado", "Blueberry", "Cherry");

$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

echo 'fruits = ("';
$jumlah = count($fruits);
for ($i = 0; $i < $jumlah; $i++) {
    echo $fruits[$i];
    if ($i < $jumlah - 1) {
        echo '", "';
    }
}
echo '")<br>';
echo "nilai dengan indeks tertinggi: " . end($fruits) . "<br><br>";


// tugas 1.2
unset($fruits[1]); // hapus blueberry
echo "data blueberry dihapus.<br>";

$fruits = array_values($fruits);

echo 'fruits = ("';
$jumlah_baru = count($fruits);
for ($i = 0; $i < $jumlah_baru; $i++) {
    echo $fruits[$i];
    if ($i < $jumlah_baru - 1) {
        echo '", "';
    }
}
echo '")<br>';
echo "nilai dengan indeks tertinggi: " . end($fruits) . "<br>";
?>