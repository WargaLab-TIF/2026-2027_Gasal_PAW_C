<!-- soal 1.1 -->
<?php  
$fruits = array("Avocado", "Blueberry", "Cherry");

array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");
echo "fruits = (";

foreach ($fruits as $f => $fruit) {
	echo "\"$fruit\"" . ($f < count($fruits) - 1 ?"," : "");
}
echo ")<br>";

$highest_index = count($fruits) - 1;
echo "Nilai dengan index yang tertinggi: " . $fruits[$highest_index];
echo "<br>";
?> 

<!-- soal 1.2 -->
<?php  
$fruits = array("Avocado", "Blueberry", "Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew");
unset($fruits[1]);
echo "Data Blueberry dihapus.<br>";

$fruits = array_values($fruits);

echo "fruits = (";
foreach ($fruits as $f => $fruit) {
	echo "\"$fruit\"" . ($f < count($fruits) - 1 ?"," : "");
}
echo ")<br>";

$highest_index = count($fruits) - 1;
echo "Nilai dengan index yang tertinggi: " . $fruits[$highest_index];
?>