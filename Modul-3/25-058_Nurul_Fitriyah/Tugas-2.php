<!-- soal 2.1 -->
<?php  
$fruits = array("Avocado", "Blueberry", "Cherry");

for ($i=1; $i <= 5 ; $i++) { 
	$fruits[] = "Buah Tambahan " . $i;
}

$arrlength = count($fruits);
echo "Panjang array saat ini: " . $arrlength . "<br><br>";

for ($x=0; $x < $arrlength ; $x++) { 
	echo $fruits[$x];
	echo "<br>";
}
?>

<!-- soal 2.2 -->
<?php  
$vegies = array("Carrot", "Broccoli", "spinach");
$vegies_length = count($vegies);

for ($i=0; $i < $vegies_length ; $i++) { 
	echo $vegies[$i] . "<br>";
}
?>