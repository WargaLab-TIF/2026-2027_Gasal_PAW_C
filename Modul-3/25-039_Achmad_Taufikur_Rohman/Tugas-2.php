<?php

$fruits = array("Avocado", "Blueberry", "Cherry");
for ($i = 1; $i <= 5; $i++) {
    $fruits[] = "Buah Tambahan " . $i;
}
echo "Panjang array saat ini: " . count($fruits) . "<br><br>";

foreach ($fruits as $fruit) {
    echo $fruit . "<br>";
}

echo "<br>";

$vegies = array("Carrot", "Broccoli", "Spinach");

foreach ($vegies as $vegie) {
    echo $vegie . "<br>";
}

?>