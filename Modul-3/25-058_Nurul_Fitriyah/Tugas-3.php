<!-- soal 3.1 -->
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
echo ")<br>";

$keys = array_keys($height);
$last_key= end($keys);
echo "Nilai dengan index terakhir: " . $height[$last_key] . "<br><br>";

unset($height["Barry"]);

echo "height = (";
foreach ($height as $key => $value) {
	echo "\"$key\"=>\"$value\",";
}
echo ")<br>";

$keys = array_keys($height);
$last_key= end($keys);
echo "Nilai dengan index terakhir stelah dihapus: " . $height[$last_key];
echo "<br><br>";
?>

<!-- soal 3.2 -->
<?php  
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

echo "weight = (";
foreach ($weight as $key => $value) {
	echo "\"$key\"=>\"$value\"" . ($key !== "Charlie" ? ", " : "");
}
echo ")<br>";

$values = array_values($weight);
echo "Data kedua: " . $values[1];
?>
