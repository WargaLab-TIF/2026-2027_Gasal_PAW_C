<?php 
// 1. array_push()
$arr1 = array("A");
echo "<b>1. array_push()</b><br>";
echo "Array awal: "; var_dump($arr1); echo "<br>";
array_push($arr1, "B");
echo "Hasil: "; var_dump($arr1); echo "<br><br>";

// 2. array_merge()
$arr2 = array("A", "B");
$arr3 = array("C");
echo "<b>2. array_merge()</b><br>";
echo "Array awal 1: "; var_dump($arr2); echo "<br>";
echo "Array awal 2: "; var_dump($arr3); echo "<br>";
$hasil_merge = array_merge($arr2, $arr3);
echo "Hasil: "; var_dump($hasil_merge); echo "<br><br>";

// 3. array_values()
$arr_assoc = array("x" => 1, "y" => 2);
echo "<b>3. array_values()</b><br>";
echo "Array awal: "; var_dump($arr_assoc); echo "<br>";
$hasil_values = array_values($arr_assoc);
echo "Hasil: "; var_dump($hasil_values); echo "<br><br>";

// 4. array_search()
$arr_search = array("A", "B", "C");
echo "<b>4. array_search()</b><br>";
echo "Array awal: "; var_dump($arr_search); echo "<br>";
$posisi = array_search("B", $arr_search);
echo "Posisi index untuk 'B': " . $posisi . "<br><br>";

// 5. array_filter()
$arr_filter = array(0, 1, false, 2, "", 3, "array");
echo "<b>5. array_filter()</b><br>";
echo "Array awal: "; var_dump($arr_filter); echo "<br>";
$hasil_filter = array_filter($arr_filter);
echo "Hasil: "; var_dump($hasil_filter); echo "<br><br>";

// 6. Sorting (sort & rsort)
$nums = array(3, 1, 2);
echo "<b>6. Sorting (sort & rsort)</b><br>";
echo "Array awal: "; var_dump($nums); echo "<br>";

$s1 = $nums; sort($s1);
echo "Hasil sort (Ascending): "; var_dump($s1); echo "<br>";

$s2 = $nums; rsort($s2);
echo "Hasil rsort (Descending): "; var_dump($s2); echo "<br><br>";

// 7. Sorting Asosiatif (asort, ksort, arsort, krsort)
$people = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo "<b>7. Sorting Asosiatif</b><br>";
echo "Array awal: "; var_dump($people); echo "<br>";

$p1 = $people; asort($p1);
echo "Hasil asort (urut nilai): "; var_dump($p1); echo "<br>";

$p2 = $people; ksort($p2);
echo "Hasil ksort (urut kunci): "; var_dump($p2); echo "<br>";

$p3 = $people; arsort($p3);
echo "Hasil arsort (balik urut nilai): "; var_dump($p3); echo "<br>";

$p4 = $people; krsort($p4);
echo "Hasil krsort (balik urut kunci): "; var_dump($p4);
?>