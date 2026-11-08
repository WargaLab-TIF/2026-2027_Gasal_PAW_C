<?php
// array_push
$arr = array("A");
array_push($arr, "B");
echo "Hasil array_push: " . implode(" ", $arr) . "<br>";

// array_merge
$arr1 = array("A", "B");
$arr2 = array("C");
$merged = array_merge($arr1, $arr2);
echo "Hasil array_merge: " . implode(" ", $merged) . "<br>";

// array_values
$assoc = array("x"=>1, "y"=>2);
echo "Hasil array_values: " . implode(" ", array_values($assoc)) . "<br>";

// array_search
$searchArr = array("A", "B", "C");
echo "Hasil array_search (mencari B): " . array_search("B", $searchArr) . "<br>";

// array_filter
$filterArr = array(0, 1, false, 2, "", 3, "array");
$filtered = array_filter($filterArr);
echo "Hasil array_filter: " . implode(" ", $filtered) . "<br>";

// Sorting
$sortArr1 = array(3, 1, 2);
sort($sortArr1);
echo "Hasil sort: " . implode(" ", $sortArr1) . "<br>";

$sortArr2 = array(3, 1, 2);
rsort($sortArr2);
echo "Hasil rsort: " . implode(" ", $sortArr2) . "<br>";

// Asosiatif Sorting
$assocSort = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
$asortArr = $assocSort; asort($asortArr);
$ksortArr = $assocSort; ksort($ksortArr);
$arsortArr = $assocSort; arsort($arsortArr);
$krsortArr = $assocSort; krsort($krsortArr);
?>