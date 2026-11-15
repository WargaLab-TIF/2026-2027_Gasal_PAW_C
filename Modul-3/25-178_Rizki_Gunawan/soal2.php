<?php
echo "2.1";
$fruits = array("Avocado", "Blueberry", "Cherry");
for ($i = 1; $i <= 5; $i++) {
    $fruits[] = "Buah Baru " . $i;
}
$panjangarray = count($fruits);
echo "Panjang array saat ini: " . $panjangarray . "<br>";
for ($i = 0; $i < $panjangarray; $i++) {
    echo $fruits[$i] . "<br>";
}
echo "<br>";
echo "<br>";
echo "2.2";
echo "<br>";
$vegies =["Carrot", "Broccoli", "Spinach"];
$panjang=count($vegies);
for ($j=0; $j<$panjang; $j++){
    echo $vegies[$j]."<br>";
}
?>
