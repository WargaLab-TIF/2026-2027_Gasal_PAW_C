php
<?php

// 1. Fungsi array_push()
$array = array("A");

echo "Array awal: ";
print_r($array);

array_push($array, "B");

echo "<br>Hasil array_push: ";
print_r($array);


// 2. Fungsi array_merge()
$array1 = array("A", "B");
$array2 = array("C");

echo "<br><br>Array awal: ";
print_r($array1);

$hasil = array_merge($array1, $array2);

echo "<br>Hasil array_merge: ";
print_r($hasil);


// 3. Fungsi array_values()
$array = array("x" => 1, "y" => 2);

echo "<br><br>Array awal: ";
print_r($array);

$hasil = array_values($array);

echo "<br>Hasil array_values: ";
print_r($hasil);


// 4. Fungsi array_search()
$array = array("A", "B", "C");

echo "<br><br>Mencari B pada array: ";
print_r($array);

$hasil = array_search("B", $array);

echo "<br>Hasil array_search: ";
var_dump($hasil);


// 5. Fungsi array_filter()
$array = array(0, 1, false, 2, "", 3, "array");

echo "<br><br>Array awal: ";
print_r($array);

$hasil = array_filter($array);

echo "<br>Hasil array_filter: ";
print_r($hasil);


// 6. Fungsi sort()
$array = array(3, 1, 2);

sort($array);

echo "<br><br>Array awal: (3, 1, 2)";
echo "<br>Hasil sort: ";
print_r($array);


// 7. Fungsi rsort()
$array = array(3, 1, 2);

rsort($array);

echo "<br>Hasil rsort: ";
print_r($array);


// 8. Fungsi asort()
$array = array(
    "Peter" => 35,
    "Ben" => 37,
    "Joe" => 43
);

asort($array);

echo "<br><br>Array awal: ";
print_r($array);

echo "<br>Hasil asort: ";
print_r($array);


// 9. Fungsi arsort()
$array = array(
    "Peter" => 35,
    "Ben" => 37,
    "Joe" => 43
);

arsort($array);

echo "<br>Hasil arsort: ";
print_r($array);


// 10. Fungsi ksort()
$array = array(
    "Peter" => 35,
    "Ben" => 37,
    "Joe" => 43
);

ksort($array);

echo "<br>Hasil ksort: ";
print_r($array);


// 11. Fungsi krsort()
$array = array(
    "Peter" => 35,
    "Ben" => 37,
    "Joe" => 43
);

krsort($array);

echo "<br>Hasil krsort: ";
print_r($array);

?>