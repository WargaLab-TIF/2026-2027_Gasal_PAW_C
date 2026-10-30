<?php 

// Buat array baru bernama $weight yang memiliki tiga data, lalu tampilkan data kedua dari array ini!


$weight = array(
	"Andy" => "70",
	"Barry" => "65",
	"Charlie" => "75"
);

echo "weight = ";
var_dump($weight);
echo "<br>";
echo "Data kedua : " . $weight["Barry"];
 ?>