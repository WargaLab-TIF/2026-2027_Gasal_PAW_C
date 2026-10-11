<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";
$hapus = ($fruits[1]);
unset($fruits[1]);
echo "Data ", $hapus," Dihapus dalam array","<br>";
$fruits = array_values($fruits);
print_r($fruits);
echo "<br>";
echo "Array nilai dengan indeks tertinggi adalah : ", $fruits[count($fruits)-1];
?>