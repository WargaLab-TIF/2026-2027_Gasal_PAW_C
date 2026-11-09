<?php
$height = array(
    "Andy" => 176,
    "Barry" => 165,
    "Charlie" => 170
);

// Menambahkan lima data baru
$height["David"] = 180;
$height["Ethan"] = 172;
$height["Frank"] = 168;
$height["George"] = 175;
$height["Harry"] = 182;

echo 'height = (';
echo '"' . implode('", "', array_map(
    fn($key, $value) => $key . '" => "' . $value,
    array_keys($height),
    array_values($height)
)) . '")';
echo "<br>";

echo "Nilai dengan indeks terakhir: " .
     array_values($height)[count($height) - 1];

echo "<br><br>";

// Menghapus data Barry
unset($height["Barry"]);

echo 'height = (';
echo '"' . implode('", "', array_map(
    fn($key, $value) => $key . '" => "' . $value,
    array_keys($height),
    array_values($height)
)) . '")';
echo "<br>";

echo "Nilai dengan indeks terakhir: " .
     array_values($height)[count($height) - 1];
?>