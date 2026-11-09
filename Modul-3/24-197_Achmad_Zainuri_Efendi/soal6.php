<?php
$arr_a = array("A");
echo "Array awal: (\"A\")<br>";
array_push($arr_a, "B");
echo "Hasil array_push: " . implode(" ", $arr_a) . "<br><br>";

$arr_b = array("C");
echo "Array awal: (\"A\", \"B\") digabung dengan (\"C\")<br>";
$merged = array_merge($arr_a, $arr_b);
echo "Hasil array_merge: " . implode(" ", $merged) . "<br><br>";

$arr_assoc = array("x"=>1, "y"=>2);
echo "Array awal: (\"x\"=>1, \"y\"=>2)<br>";
$vals = array_values($arr_assoc);
echo "Hasil array_values: " . implode(" ", $vals) . "<br><br>";

echo "Mencari \"B\" pada array: (\"A\", \"B\", \"C\")<br>";
echo "Hasil array_search: " . array_search("B", $merged) . "<br><br>";

$arr_mixed = array(0, 1, false, 2, "", 3, "array");
echo "Array awal: (0, 1, false, 2, \"\", 3, \"array\")<br>";
$filtered = array_filter($arr_mixed);
echo "Hasil array_filter: " . implode(" ", $filtered) . "<br><br>";

$arr_sort = array(3, 1, 2);
echo "Array awal: (3, 1, 2)<br>";
sort($arr_sort);
echo "Hasil sort: " . implode(" ", $arr_sort) . "<br>";
rsort($arr_sort);
echo "Hasil rsort: " . implode(" ", $arr_sort) . "<br><br>";

$arr_age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
echo "Array awal: (\"Peter\"=>35, \"Ben\"=>37, \"Joe\"=>43)<br>";

$asort_arr = $arr_age; asort($asort_arr);
echo "Hasil asort: "; foreach($asort_arr as $k => $v) echo "$k=>$v, "; echo "<br>";

$ksort_arr = $arr_age; ksort($ksort_arr);
echo "Hasil ksort: "; foreach($ksort_arr as $k => $v) echo "$k=>$v, "; echo "<br>";

$arsort_arr = $arr_age; arsort($arsort_arr);
echo "Hasil arsort: "; foreach($arsort_arr as $k => $v) echo "$k=>$v, "; echo "<br>";

$krsort_arr = $arr_age; krsort($krsort_arr);
echo "Hasil krsort: "; foreach($krsort_arr as $k => $v) echo "$k=>$v, "; echo "<br>";
?>