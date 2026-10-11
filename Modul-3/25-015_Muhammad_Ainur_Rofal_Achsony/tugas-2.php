<?php
// 2.1 : tambah 5 data baru dengan perulangan for
$fruits = array("Avocado", "Blueberry", "Cherry");
for ($i = 1; $i <= 5; $i++) {
    $fruits[] = "Buah Tambahan " . $i;
}
$arrlength = count($fruits);

// 2.2 : array baru $vegies isi 3 data
$vegies = array("Carrot", "Broccoli", "Spinach");
$arrlength_vegies = count($vegies);

echo "Panjang array saat ini: " . $arrlength . "<br><br>";
for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x] . "<br>";
}

echo "<br>";

for ($x = 0; $x < $arrlength_vegies; $x++) {
    echo $vegies[$x] . "<br>";
}
?>
