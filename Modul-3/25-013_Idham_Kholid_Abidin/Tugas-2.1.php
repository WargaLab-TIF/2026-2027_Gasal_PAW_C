<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlenght = count($fruits);

for($i = 1; $i <= 5; $i++){
	$fruits[] = "Buah tambahan ". $i;
};

$arrlenght = count($fruits);
echo "Panjang array saat ini : ", $arrlenght;
echo "<br>";
echo "<br>";

for($i = 0; $i < $arrlenght; $i++){
	echo $fruits[$i];
	echo "<br>";
}
echo "<br>";
echo "Skrip perulangan for pada baris #5-#8 tidak perlu diubah, ";
echo "karena \$arrlenght sudah dihitung ulang dengan count(\$fruits) ";
echo "setelah data ditambah sehingga seluruh data tampil.";
?> 