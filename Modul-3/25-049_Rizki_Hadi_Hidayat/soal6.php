<?php
$arr_push = array("A");
echo 'array awal: ("A")<br>';
array_push($arr_push, "B");
echo "hasil array_push: ";
foreach ($arr_push as $nilai) {
    echo $nilai . " ";
}
echo "<br><br>";


$arr1 = array("A", "B");
$arr2 = array("C");
echo 'array awal: ("A", "B") digabung dengan ("C")<br>';
$gabung = array_merge($arr1, $arr2);
echo "hasil array_merge: ";
foreach ($gabung as $nilai) {
    echo $nilai . " ";
}
echo "<br><br>";


$arr_assoc = array("x"=>1, "y"=>2);
echo 'array awal: ("x"=>1, "y"=>2)<br>';
$cuma_nilai = array_values($arr_assoc);
echo "hasil array_values: ";
foreach ($cuma_nilai as $nilai) {
    echo $nilai . " ";
}
echo "<br><br>";


$arr_search = array("A", "B", "C");
echo 'mencari "B" pada array: ("A", "B", "C")<br>';
$cari = array_search("B", $arr_search);
echo "hasil array_search: " . $cari . "<br><br>";


$arr_filter = array(0, 1, false, 2, "", 3, "array");
echo 'array awal: (0, 1, false, 2, "", 3, "array")<br>';
$bersih = array_filter($arr_filter);
echo "hasil array_filter: ";
foreach ($bersih as $nilai) {
    echo $nilai . " ";
}
echo "<br><br>";


$arr_sort = array(3, 1, 2);
echo 'array awal: (3, 1, 2)<br>';
sort($arr_sort);
echo "hasil sort: ";
foreach ($arr_sort as $nilai) {
    echo $nilai . "";
}
echo "<br>";


$arr_rsort = array(3, 1, 2);
rsort($arr_rsort);
echo "hasil rsort: ";
foreach ($arr_rsort as $nilai) {
    echo $nilai . "";
}
echo "<br><br>";


$umur = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
echo 'array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';

$temp_asort = $umur; asort($temp_asort);
echo "hasil asort: "; 
foreach($temp_asort as $n => $u) echo "$n=>$u, "; 
echo "<br>";

$temp_ksort = $umur; ksort($temp_ksort);
echo "hasil ksort: "; 
foreach($temp_ksort as $n => $u) echo "$n=>$u, "; 
echo "<br>";

$temp_arsort = $umur; arsort($temp_arsort);
echo "hasil arsort: "; 
foreach($temp_arsort as $n => $u) echo "$n=>$u, "; 
echo "<br>";

$temp_krsort = $umur; krsort($temp_krsort);
echo "hasil krsort: "; 
foreach($temp_krsort as $n => $u) echo "$n=>$u, "; 
echo "<br>";
?>