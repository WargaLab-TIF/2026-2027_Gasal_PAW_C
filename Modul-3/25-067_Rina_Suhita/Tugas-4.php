<?php
function tampilAsosiatif($nama, $arr) {
    $item = array();
    foreach ($arr as $k => $v) {
        $item[] = '"' . $k . '"=>"' . $v . '"';
    }
    echo $nama . " = (" . implode(", ", $item) . ")<br>";
}

// 4.1 Menambahkan lima data baru, lalu menampilkan seluruh data dengan perulangan 
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

$height["David"]  = "180";
$height["Ethan"]  = "172";
$height["Frank"]  = "168";
$height["George"] = "175";
$height["Harry"]  = "182";

tampilAsosiatif("height", $height);
echo "<br>";

foreach ($height as $nama => $tinggi) {
    echo $nama . " is " . $tinggi . " cm tall.<br>";
}

echo "<br>";

// 4.2 Array baru $weight dengan tiga data, kemudian menampilkan seluruh data dengan perulangan FOR
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

tampilAsosiatif("weight", $weight);
echo "<br>";

$keys   = array_keys($weight);  
$jumlah = count($weight);

for ($i = 0; $i < $jumlah; $i++) {
    echo $keys[$i] . " is " . $weight[$keys[$i]] . " kg.<br>";
}
?>