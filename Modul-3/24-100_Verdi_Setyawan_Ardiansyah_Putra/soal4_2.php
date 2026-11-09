<?php
$weight = array(
    "Andy" => "70",
    "Barry" => "65",
    "Charlie" => "75"
);

$nama = array_keys($weight);
$arrlength = count($weight);

for ($i = 0; $i < $arrlength; $i++) {
    echo htmlspecialchars($nama[$i]) . " is " . htmlspecialchars($weight[$nama[$i]]) . " kg.<br>";
}
?>
