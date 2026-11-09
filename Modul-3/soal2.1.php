<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

for ($i = 1; $i <= 5; $i++) {
    $fruits[] = "Buah Tambahan " . $i;
}

$arrayLength = count($fruits);

echo "Panjang array saat ini: " . $arrayLength;
echo "<br><br>";

for ($x = 0; $x < $arrayLength; $x++) {
    echo $fruits[$x] . "<br>";
}
?>