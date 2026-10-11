<?php
$students = array(
	array("Alex", "220401", "0812345678"),
	array("Bianca", "220402", "0812345687"),
	array("Candice", "220403", "0812345665")
);
echo "Data Awal : ";
print_r($students);
echo "<br>";
echo "<br>";
echo "<br>";
$students[] = array("Daniel", "220404", "0812345690");
$students[] = array("Elena", "220405", "0812345691");
$students[] = array("Fiona", "220406", "0812345692");
$students[] = array("Gabe", "220407", "0812345693");
$students[] = array("Hannah", "220408", "0812345694");
echo "Data setelah ditambah 5 data lain : ";
echo "<br>";
print_r($students);
echo "<br>";
echo "<br>";
echo "<br>";
echo "<table border='1'>";
echo "<tr><td>Name</td><td>NIM</td><td>Mobile</td></tr>";

for($i = 0; $i < count($students); $i++){
	echo "<tr>";
	for($j = 0; $j < 3; $j++){
		echo "<td>", $students[$i][$j], "</td>";
	}
	echo "</tr>";
}
echo "</table>";
?>
