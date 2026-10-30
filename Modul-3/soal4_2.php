<?php 

// Buat array baru dengan nama $weight yang memiliki tiga buah data! Tampilkan seluruh data dari array $weight dengan menggunakan stuktur perulangan FOR!

$weight = array(
	"Andy" => "70",
	"Barry" => "65",
	"Charlie" => "75"
);

echo "weight = ";
var_dump($weight);
echo "<br>";
echo "<br>";

$keys = array_keys($weight);
$panjang = count($keys);
for ($i = 0; $i < $panjang; $i++) {
    $nama = $keys[$i];
    echo $nama . " is " . $weight[$nama] . " kg.<br>";
}

 ?>