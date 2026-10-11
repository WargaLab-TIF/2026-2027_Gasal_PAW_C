<?php
// 4.1 : tambah 5 data baru
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = (\"Andy\"=>\"" . $height["Andy"] . "\", \"Barry\"=>\"" . $height["Barry"] . "\", \"Charlie\"=>\"" . $height["Charlie"] . "\", \"David\"=>\"" . $height["David"] . "\", \"Ethan\"=>\"" . $height["Ethan"] . "\", \"Frank\"=>\"" . $height["Frank"] . "\", \"George\"=>\"" . $height["George"] . "\", \"Harry\"=>\"" . $height["Harry"] . "\")<br><br>";

foreach ($height as $nama => $tinggi) {
    echo $nama . " is " . $tinggi . " cm tall.<br>";
}

echo "<br>";

// 4.2 : array baru $weight isi 3 data, tampilkan pakai for
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");
$keys_weight = array_keys($weight);

echo "weight = (\"Andy\"=>\"" . $weight["Andy"] . "\", \"Barry\"=>\"" . $weight["Barry"] . "\", \"Charlie\"=>\"" . $weight["Charlie"] . "\")<br><br>";

for ($x = 0; $x < count($keys_weight); $x++) {
    echo $keys_weight[$x] . " is " . $weight[$keys_weight[$x]] . " kg.<br>";
}
?>
