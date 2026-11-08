<!-- Tugas Point 4 -->
<?php
// Soal Utama: Mengakses array asosiatif dengan perulangan
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

// 4.1. Menambahkan lima data baru ke dalam array $height
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = (";
$keys = array_keys($height);
$last_key = end($keys);
foreach ($height as $name => $value) {
    echo "\"$name\"=>\"$value\"";
    if ($name !== $last_key) {
        echo ", ";
    }
}
echo ")<br><br>";

// Menampilkan seluruh data dengan perulangan (menggunakan foreach untuk array asosiatif)
foreach ($height as $name => $val) {
    echo "$name is $val cm tall.<br>";
}

echo "<hr>";

// 4.2. Membuat array baru bernama $weight dengan tiga data
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

echo "weight = (";
$keys_w = array_keys($weight);
$last_key_w = end($keys_w);
foreach ($weight as $name => $value) {
    echo "\"$name\"=>\"$value\"";
    if ($name !== $last_key_w) {
        echo ", ";
    }
}
echo ")<br><br>";

$keys_weight = array_keys($weight);
$arr_length = count($weight);

for ($i = 0; $i < $arr_length; $i++) {
    $nama = $keys_weight[$i];
    $berat = $weight[$nama];
    echo "$nama is $berat kg.<br>";
}
?>