<?php
function tampilArray($nama, $arr) {
    $hasil = array();
    foreach ($arr as $key => $value) {
        $hasil[] = '"' . $key . '"=>"' . $value . '"';
    }
    echo $nama . ' = (' . implode(', ', $hasil) . ')<br>';
}

$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$height["David"]  = "180";
$height["Ethan"]  = "172";
$height["Frank"]  = "168";
$height["George"] = "175";
$height["Harry"]  = "182";

tampilArray("height", $height);
$kunciTerakhir = array_key_last($height);
echo "Nilai dengan indeks terakhir: " . $height[$kunciTerakhir] . "<br><br>";

unset($height["Barry"]);

tampilArray("height", $height);
$kunciTerakhir = array_key_last($height);
echo "Nilai dengan indeks terakhir setelah dihapus: " . $height[$kunciTerakhir];
?>