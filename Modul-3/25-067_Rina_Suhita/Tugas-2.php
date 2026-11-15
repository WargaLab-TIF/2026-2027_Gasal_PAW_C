<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

// 2.1 Tambah 5 data dengan for, tampilkan panjang & isi array 
for ($i = 1; $i <= 5; $i++) {
    $fruits[] = "Buah Tambahan " . $i;       
}

$arrlength = count($fruits);                 
echo "Panjang array saat ini: " . $arrlength . "<br><br>";

for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}

echo "<hr>";

// 2.2 Array $vegies dengan 3 data
$vegies = array("Carrot", "Broccoli", "Spinach");
$arrlength = count($vegies);

echo "<br>";
for ($x = 0; $x < $arrlength; $x++) {
    echo $vegies[$x];
    echo "<br>";
}
?>