<?php

$letters = array("A");
array_push($letters, "B");
echo "Array awal: (A)<br>Hasil array_push: " . implode(", ", $letters) . "<br><br>";

$letters1 = array("A", "B");
$letters2 = array("C");
$merged = array_merge($letters1, $letters2);
echo "Array (A, B) digabung dengan (C)<br>Hasil array_merge: " . implode(", ", $merged) . "<br><br>";

$associative = array("X" => 1, "Y" => 2);
$values = array_values($associative);
echo "Array awal: (X => 1, Y => 2)<br>Hasil array_values: " . implode(", ", $values) . "<br><br>";

$searchArray = array("A", "B", "C");
$position = array_search("B", $searchArray);
echo 'Mencari "B" pada array (A, B, C)<br>Hasil array_search: ' . $position . "<br><br>";

$filterArray = array(0, 1, false, 2, "", 3, "array");
$filtered = array_filter($filterArray);
echo "Array awal: (0, 1, false, 2, empty string, 3, array)<br>Hasil array_filter: " . implode(", ", $filtered) . "<br><br>";

$numbers = array(3, 1, 2);
$sortedNumbers = $numbers;
sort($sortedNumbers);
echo "Array awal angka: (3, 1, 2)<br>Hasil sort: " . implode(", ", $sortedNumbers) . "<br>";

rsort($sortedNumbers);
echo "Hasil rsort: " . implode(", ", $sortedNumbers) . "<br><br>";

$people = array("Peter" => 35, "Ben" => 37, "Joe" => 43);

$sortedPeople = $people;
asort($sortedPeople);
echo "Array awal asosiatif: (Peter => 35, Ben => 37, Joe => 43)<br>Hasil asort: ";
tampilkanPasangan($sortedPeople);

$sortedPeople = $people;
ksort($sortedPeople);
echo "Hasil ksort: ";
tampilkanPasangan($sortedPeople);

$sortedPeople = $people;
arsort($sortedPeople);
echo "Hasil arsort: ";
tampilkanPasangan($sortedPeople);

$sortedPeople = $people;
krsort($sortedPeople);
echo "Hasil krsort: ";
tampilkanPasangan($sortedPeople);

function tampilkanPasangan($array) {
    $items = array();
    foreach ($array as $key => $value) {
        $items[] = $key . " => " . $value;
    }
    echo implode(", ", $items) . "<br>";
}
?>
