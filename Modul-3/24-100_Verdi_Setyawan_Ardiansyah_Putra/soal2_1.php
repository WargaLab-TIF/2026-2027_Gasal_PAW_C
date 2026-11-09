<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$buahTambahan = array(
    "Durian",
    "Elderberry",
    "Fig",
    "Grape",
    "Honeydew"
);

for ($i = 0; $i < count($buahTambahan); $i++) {
    $fruits[] = $buahTambahan[$i];
}

$arrlength = count($fruits);
echo "Panjang array saat ini: " . $arrlength . "<br><br>";

for ($x = 0; $x < $arrlength; $x++) {
    echo htmlspecialchars($fruits[$x]) . "<br>";
}
?>
