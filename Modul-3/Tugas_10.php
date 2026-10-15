<?php
// array_push
$arr1 = array("A");
array_push($arr1, "B");
echo "Hasil array_push: " . implode(" ", $arr1) . "<br>";

// array_merge
$arr2 = array("A", "B");
$arr3 = array("C");
$merged = array_merge($arr2, $arr3);
echo "Hasil array_merge: " . implode(" ", $merged) . "<br>";

// array_values
$arr4 = array("x"=>1, "y"=>2);
$vals = array_values($arr4);
echo "Hasil array_values: " . implode(" ", $vals) . "<br>";

// array_search
$arr5 = array("A", "B", "C");
$search = array_search("B", $arr5);
echo "Hasil array_search: " . $search . "<br>";

// array_filter
$arr6 = array(0, 1, false, 2, "", 3, "array");
$filtered = array_filter($arr6);
echo "Hasil array_filter: " . implode(" ", $filtered) . "<br>";

// sort & rsort (Array Terindeks)
$arr7 = array(3, 1, 2);
sort($arr7);
echo "Hasil sort: " . implode("", $arr7) . "<br>";
rsort($arr7);
echo "Hasil rsort: " . implode("", $arr7) . "<br>";

// asort, ksort, arsort, krsort (Array Asosiatif)
$arr8 = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

asort($arr8);
echo "Hasil asort: "; foreach($arr8 as $k=>$v) echo "$k=>$v, "; echo "<br>";

$arr8 = array("Peter"=>35, "Ben"=>37, "Joe"=>43); // reset
ksort($arr8);
echo "Hasil ksort: "; foreach($arr8 as $k=>$v) echo "$k=>$v, "; echo "<br>";

$arr8 = array("Peter"=>35, "Ben"=>37, "Joe"=>43); // reset
arsort($arr8);
echo "Hasil arsort: "; foreach($arr8 as $k=>$v) echo "$k=>$v, "; echo "<br>";

$arr8 = array("Peter"=>35, "Ben"=>37, "Joe"=>43); // reset
krsort($arr8);
echo "Hasil krsort: "; foreach($arr8 as $k=>$v) echo "$k=>$v, "; echo "<br>";
?> 