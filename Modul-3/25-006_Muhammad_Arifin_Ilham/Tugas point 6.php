<!-- Tugas Point 6 -->
<?php
// 1. array_push()
$arr1 = array("A");
echo "Array awal: (\"A\")<br>";
array_push($arr1, "B");
echo "Hasil array_push: " . implode(" ", $arr1) . "<br><br>";

// 2. array_merge()
$arr2_1 = array("A", "B");
$arr2_2 = array("C");
echo "Array awal: (\"A\", \"B\") digabung dengan (\"C\")<br>";
$merged = array_merge($arr2_1, $arr2_2);
echo "Hasil array_merge: " . implode(" ", $merged) . "<br><br>";

// 3. array_values()
$arr3 = array("X" => 1, "Y" => 2);
echo "Array awal: (\"X\" => 1, \"Y\" => 2)<br>";
$values = array_values($arr3);
echo "Hasil array_values: " . implode(" ", $values) . "<br><br>";

// 4. array_search()
$arr4 = array("A", "B", "C");
echo "Mencari \"B\" pada array: (\"A\", \"B\", \"C\")<br>";
$key = array_search("B", $arr4);
echo "Hasil array_search: " . $key . "<br><br>";

// 5. array_filter()
$arr5 = array(0, 1, false, 2, "", 3, "array");
echo "Array awal: (0, 1, false, 2, \"\", 3, \"array\")<br>";
$filtered = array_filter($arr5);
echo "Hasil array_filter: ";
foreach ($filtered as $val) {
    echo $val . " ";
}
echo "<br><br>";

// 6. Sorting Array Terindeks (sort & rsort)
$arr6 = array(3, 1, 2);
echo "Array awal: (3, 1, 2)<br>";
$sort_asc = $arr6;
sort($sort_asc);
echo "Hasil sort: " . implode(" ", $sort_asc) . "<br>";

$sort_desc = $arr6;
rsort($sort_desc);
echo "Hasil rsort: " . implode(" ", $sort_desc) . "<br><br>";

// 7. Sorting Array Asosiatif (asort, ksort, arsort, krsort)
$arr7 = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo "Array awal: (\"Peter\"=>35, \"Ben\"=>37, \"Joe\"=>43)<br>";

// asort (mengurutkan berdasarkan nilai secara ascending)
$asort_arr = $arr7;
asort($asort_arr);
echo "Hasil asort: ";
$out = array();
foreach ($asort_arr as $k => $v) {
    $out[] = "$k=>$v";
}
echo implode(", ", $out) . "<br>";

// ksort (mengurutkan berdasarkan key secara ascending)
$ksort_arr = $arr7;
ksort($ksort_arr);
echo "Hasil ksort: ";
$out = array();
foreach ($ksort_arr as $k => $v) {
    $out[] = "$k=>$v";
}
echo implode(", ", $out) . "<br>";

// arsort (mengurutkan berdasarkan nilai secara descending)
$arsort_arr = $arr7;
arsort($arsort_arr);
echo "Hasil arsort: ";
$out = array();
foreach ($arsort_arr as $k => $v) {
    $out[] = "$k=>$v";
}
echo implode(", ", $out) . "<br>";

// krsort (mengurutkan berdasarkan key secara descending)
$krsort_arr = $arr7;
krsort($krsort_arr);
echo "Hasil krsort: ";
$out = array();
foreach ($krsort_arr as $k => $v) {
    $out[] = "$k=>$v";
}
echo implode(", ", $out);
?>