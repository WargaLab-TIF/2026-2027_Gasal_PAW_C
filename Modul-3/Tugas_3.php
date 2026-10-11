<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

// Menambahkan 5 data baru dengan perulangan for
for($i = 1; $i <= 5; $i++) {
    $fruits[] = "Buah Tambahan " . $i;
}

// Menghitung panjang array terbaru
$panjang_array = count($fruits);
echo "Panjang array saat ini: " . $panjang_array . "<br>";

// Menampilkan seluruh data
for($x = 0; $x < $panjang_array; $x++) {
    echo $fruits[$x]. "<br>";
}
?>