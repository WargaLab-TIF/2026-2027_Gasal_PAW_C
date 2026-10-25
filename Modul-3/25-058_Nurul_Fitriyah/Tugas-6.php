<!-- soal 6.1 -->
<?php
// 1. array_push()
$arr1 = array("A");
echo 'Array awal: ("A")<br>';
array_push($arr1, "B");
echo "Hasil array_push: " . implode(" ", $arr1) . "<br><br>";

// 2. array_merge()
$arr2 = array("A", "B");
$arr3 = array("C");
echo 'Array awal: ("A", "B") digabung dengan ("C")<br>';
$merged = array_merge($arr2, $arr3);
echo "Hasil array_merge: " . implode(" ", $merged) . "<br><br>";

// 3. array_values()
$assoc = array("x" => 1, "y" => 2);
echo 'Array awal: ("x" => 1, "y" => 2)<br>';
$values = array_values($assoc);
echo "Hasil array_values: " . implode(" ", $values) . "<br><br>";

// 4. array_search()
$search_arr = array("A", "B", "C");
echo 'Mencari "B" pada array: ("A", "B", "C")<br>';
$index = array_search("B", $search_arr);
echo "Hasil array_search: " . $index . "<br><br>";

// 5. array_filter()
$filter_arr = array(0, 1, false, 2, "", 3, "array");
echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';
// Tanpa callback, array_filter akan menghapus nilai false/empty/0
$filtered = array_filter($filter_arr); 
echo "Hasil array_filter: " . implode(" ", $filtered) . " array<br><br>";

// 6. Fungsi Sorting pada Indexed Array (sort & rsort)
$numbers = array(3, 1, 2);
echo 'Array awal: (3, 1, 2)<br>';
sort($numbers);
echo "Hasil sort: " . implode(" ", $numbers) . "<br>";
rsort($numbers);
echo "Hasil rsort: " . implode(" ", $numbers) . "<br><br>";

// 7. Fungsi Sorting pada Array Asosiatif (asort, ksort, arsort, krsort)
$age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';

asort($age); // Berdasarkan Value Ascending
echo "Hasil asort: ";
$count = count($age);
$i = 0;
foreach($age as $k => $v) {
    $i++;
    echo "$k=><span>$v</span>" . ($i < $count ? ", " : ".");
}
echo "<br>";

ksort($age); // Berdasarkan Key Ascending
echo "Hasil ksort: ";
$i = 0;
foreach($age as $k => $v) {
    $i++;
    echo "$k=><span>$v</span>" . ($i < $count ? ", " : ".");
}
echo "<br>";

arsort($age); // Berdasarkan Value Descending
echo "Hasil arsort: ";
$i = 0;
foreach($age as $k => $v) {
    $i++;
    echo "$k=><span>$v</span>" . ($i < $count ? ", " : ".");
}
echo "<br>";

krsort($age); // Berdasarkan Key Descending
echo "Hasil krsort: ";
$i = 0;
foreach($age as $k => $v) {
    $i++;
    echo "$k=><span>$v</span>" . ($i < $count ? ", " : ".");
}
?>