<?php 
$fruits = array("Avocado","Blueberry","Cerry");
array_push($fruits,"Durian", "Elderberry", "Fig", "Grape", "Honeydew");
echo "fruits = (";
foreach ($fruits as $buah) {
    echo $buah . ", ";
}
echo ") <br>";
echo "Nilai dengan indeks tertinggi : " . $fruits[array_key_last($fruits)];
?>