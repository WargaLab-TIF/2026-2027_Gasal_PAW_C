<?php
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

function tampilkanHeight($height) {
    $data = array();
    foreach ($height as $nama => $tinggi) {
        $data[] = '"' . $nama . '" => "' . $tinggi . '"';
    }
    echo 'height = (' . implode(', ', $data) . ')<br>';
}

tampilkanHeight($height);
$nilaiTerakhir = end($height);
echo "Nilai dengan indeks terakhir: " . $nilaiTerakhir . "<br><br>";

unset($height["Barry"]);
echo "Data Barry dihapus.<br>";
tampilkanHeight($height);
$nilaiTerakhir = end($height);
echo "Nilai dengan indeks terakhir setelah dihapus: " . $nilaiTerakhir;
?>
