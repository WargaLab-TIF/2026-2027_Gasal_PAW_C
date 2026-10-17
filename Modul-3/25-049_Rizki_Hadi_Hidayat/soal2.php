<?php
// tugas 2.1
$fruits = array("Avocado", "Blueberry", "Cherry");

for ($i = 1; $i <= 5; $i++) {
    $fruits[] = "buah tambahan " . $i;
}

$arrlength = count($fruits);
echo "panjang array saat ini: " . $arrlength . "<br>";

for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x] . "<br>";
}
echo "<br>";


// tugas 2.2
$vegies = array("Carrot", "Broccoli", "Spinach");
$panjang_vegies = count($vegies);

for ($x = 0; $x < $panjang_vegies; $x++) {
    echo $vegies[$x] . "<br>";
}
?>