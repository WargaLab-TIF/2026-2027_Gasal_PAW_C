<?php 

// Tambahkan lima data baru ke dalam array $height, lalu tampilkan seluruh datanya dengan perulangan!

$height = array("Andy"=>"176","Barry"=>"165","Charlie"=>"170");

echo "height = ";
var_dump($height);
echo "<br>";
echo "<br>";

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

foreach ($height as $nama => $tinggi) {
	echo $nama . " is" . $tinggi . " cm tall <br>";
}

 ?>