<?php
// tugas 4.1
$height = array(
    "Andy"=>"176", "Barry"=>"165", "Charlie"=>"170", 
    "David"=>"180", "Ethan"=>"172", "Frank"=>"168", 
    "George"=>"175", "Harry"=>"182"
);

foreach ($height as $nama => $tinggi) {
    echo $nama . " is " . $tinggi . " cm tall.<br>";
}
echo "<br>";


// tugas 4.2
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

$nama_orang = array_keys($weight);
$jumlah_orang = count($nama_orang);

for ($i = 0; $i < $jumlah_orang; $i++) {
    $nama = $nama_orang[$i];
    $berat = $weight[$nama];
    echo $nama . " is " . $berat . " kg.<br>";
}
?>