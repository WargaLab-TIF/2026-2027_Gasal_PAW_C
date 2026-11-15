<?php
function tampilAsosiatif($nama, $arr) {
    $item = array();
    foreach ($arr as $k => $v) {
        $item[] = '"' . $k . '"=>"' . $v . '"';
    }
    echo $nama . " = (" . implode(", ", $item) . ")<br>";
}

// 3.1 Menambahkan lima data baru, lalu tampilkan nilai dengan indeks (key) terakhir, setelah itu hapus satu data tertentu (Barry),
// lalu tampilkan kembali nilai dengan indeks terakhir
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

$height["David"]  = "180";
$height["Ethan"]  = "172";
$height["Frank"]  = "168";
$height["George"] = "175";
$height["Harry"]  = "182";

tampilAsosiatif("height", $height);
echo "Nilai dengan indeks terakhir: " . $height[array_key_last($height)] . "<br>";
echo "<br>";
unset($height["Barry"]);

tampilAsosiatif("height", $height);
echo "Nilai dengan indeks terakhir setelah dihapus: " . $height[array_key_last($height)] . "<br>";

echo "<br>";

// 3.2 Array baru $weight dengan tiga data, lalu tampilkan data kedua
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

tampilAsosiatif("weight", $weight);

$nilai = array_values($weight);
echo "Data kedua: " . $nilai[1] . "<br>";
?>