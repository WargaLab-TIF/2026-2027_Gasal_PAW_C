<?php
// tugas 3.1
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo 'height = (';
$hitung = 0;
$total = count($height);
foreach ($height as $nama => $tinggi) {
    echo '"' . $nama . '"=>"' . $tinggi . '"';
    $hitung++;
    if ($hitung < $total) { echo ', '; }
}
echo ')<br>';
echo "nilai dengan indeks terakhir: " . end($height) . "<br><br>";

// hapus barry
unset($height["Barry"]);

echo 'height = (';
$hitung = 0;
$total = count($height);
foreach ($height as $nama => $tinggi) {
    echo '"' . $nama . '"=>"' . $tinggi . '"';
    $hitung++;
    if ($hitung < $total) { echo ', '; }
}
echo ')<br>';
echo "nilai dengan indeks terakhir setelah dihapus: " . end($height) . "<br><br>";


// tugas 3.2 
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

echo 'weight = (';
$hitung = 0;
$total = count($weight);
foreach ($weight as $nama => $berat) {
    echo '"' . $nama . '"=>"' . $berat . '"';
    $hitung++;
    if ($hitung < $total) { echo ', '; }
}
echo ')<br>';
echo "data kedua: " . $weight["Barry"] . "<br>";
?>