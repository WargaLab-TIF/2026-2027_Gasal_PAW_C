<!-- soal 4.1 -->
<?php  
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = (";
foreach ($height as $key => $value) {
	echo "\"$key\" => \"$value\",";
}
echo ")<br><br>";

foreach ($height as $name => $tall) {
	echo "$name is $tall cm tall.<br>";
}
echo "<br><br>";

?>

<!-- soal 4.2 -->
<?php  
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

echo "weight = (";
foreach ($weight as $key => $value) {
	echo "\"$key\"=>\"$value\",";
}
echo ")<br><br>";

$keys = array_keys($weight);
$values = array_values($weight);
$length = count($weight);

for ($i=0; $i < $length ; $i++) { 
	echo $keys[$i] . " is " . $values[$i] . " kg.<br>";
}
?>