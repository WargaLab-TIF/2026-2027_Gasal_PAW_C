<?php
$weight = array(
    "Andy" => "70",
    "Barry" => "65",
    "Charlie" => "75"
);

$nilaiWeight = array_values($weight);

echo 'weight = ("Andy" => "70", "Barry" => "65", "Charlie" => "75")<br>';
echo "Data kedua: " . $nilaiWeight[1];
?>
