<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$nama = array("David", "Ethan", "Frank", "George", "Harry");
$tinggi_badan = array("180", "172", "168", "175", "182");

for ($i = 0; $i < 5; $i++) {
    $height[$nama[$i]] = $tinggi_badan[$i];
}
foreach ($height as $nama => $tinggi_badan) {
    echo $nama . "=>" . $tinggi_badan . ", ";
}
echo "<br>Nilai terakhir: " . $height[array_key_last($height)] . "<br>";
unset($height["Harry"]);
foreach ($height as $nama => $tinggi_badan) {
    echo $nama . "=>" . $tinggi_badan . ", ";
}
echo "<br>Nilai terakhir setelah dihapus: " . $height[array_key_last($height)];
?>