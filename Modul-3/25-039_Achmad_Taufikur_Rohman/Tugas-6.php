<?php
$a = array("A");
echo "Array awal: (\"A\")<br>";
array_push($a, "B");
echo "Hasil array_push: " . implode(" ", $a) . "<br><br>";

$a1 = array("A", "B");
$a2 = array("C");
echo "Array awal: (\"A\", \"B\") digabung dengan (\"C\")<br>";
$hasil = array_merge($a1, $a2);
echo "Hasil array_merge: " . implode(" ", $hasil) . "<br><br>";

$a = array("x" => 1, "y" => 2);
echo "Array awal: (\"x\" => 1, \"y\" => 2)<br>";
$hasil = array_values($a);
echo "Hasil array_values: " . implode(" ", $hasil) . "<br><br>";

$a = array("A", "B", "C");
echo "Mencari \"B\" pada array: (\"A\", \"B\", \"C\")<br>";
echo "Hasil array_search: " . array_search("B", $a) . "<br><br>";

$a = array(0, 1, false, 2, "", 3, "array");
echo "Array awal: (0, 1, false, 2, \"\", 3, \"array\")<br>";
$hasil = array_filter($a);
echo "Hasil array_filter: " . implode(" ", $hasil) . "<br><br>";

$a = array(3, 1, 2);
echo "Array awal: (3, 1, 2)<br>";
sort($a);
echo "Hasil sort: " . implode(" ", $a) . "<br>";
rsort($a);
echo "Hasil rsort: " . implode(" ", $a) . "<br><br>";

function tampilAssoc($arr) {
    $out = "";
    foreach ($arr as $k => $v) {
        $out .= "$k=> $v, ";
    }
    return $out;
}

$age = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo "Array awal: (\"Peter\"=>35, \"Ben\"=>37, \"Joe\"=>43)<br>";

$t = $age; asort($t);
echo "Hasil asort: " . tampilAssoc($t) . "<br>";

$t = $age; ksort($t);
echo "Hasil ksort: " . tampilAssoc($t) . "<br>";

$t = $age; arsort($t);
echo "Hasil arsort: " . tampilAssoc($t) . "<br>";

$t = $age; krsort($t);
echo "Hasil krsort: " . tampilAssoc($t) . "<br>";
?>