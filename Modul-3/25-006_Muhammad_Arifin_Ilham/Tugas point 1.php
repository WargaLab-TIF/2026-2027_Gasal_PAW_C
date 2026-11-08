<!-- Tugas Point 1 -->
<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

// 1.1. Menambahkan 5 data baru dalam array $fruits
array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

echo "fruits = ( \"" . implode('", "', $fruits) . "\" )<br>";

$highest_index = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$highest_index] . "<br><br>";

// 1.2. Hapus satu data tertentu dari array $fruits (Menghapus "Blueberry")
$index_blueberry = array_search("Blueberry", $fruits);
if ($index_blueberry !== false) {
    unset($fruits[$index_blueberry]);
    $fruits = array_values($fruits);
}

echo "Data Blueberry dihapus.<br>";

// Menampilkan array setelah penghapusan
echo "fruits = ( \"" . implode('", "', $fruits) . "\" )<br>";

// Menampilkan nilai dengan indeks tertinggi yang baru
$highest_index_new = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$highest_index_new];
?>