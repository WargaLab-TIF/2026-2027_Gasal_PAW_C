<?php
// array_push() : menambah data di akhir array
$a = array("A");
echo 'Array awal: ("A")<br>';
array_push($a, "B");
echo "Hasil array_push: " . implode(" ", $a) . "<br><br>";

// array_merge() : menggabung dua array
$b = array("A", "B");
$c = array("C");
$gabung = array_merge($b, $c);
echo 'Array awal: ("A", "B") digabung dengan ("C")<br>';
echo "Hasil array_merge: " . implode(" ", $gabung) . "<br><br>";

// array_values() : mengambil nilainya saja (key dibuang)
$d = array("x" => 1, "y" => 2);
echo 'Array awal: ("x" => 1, "y" => 2)<br>';
echo "Hasil array_values: " . implode(" ", array_values($d)) . "<br><br>";

// array_search() : mencari posisi (key) sebuah nilai 
$e = array("A", "B", "C");
echo 'Mencari "B" pada array: ("A", "B", "C")<br>';
echo "Hasil array_search: " . array_search("B", $e) . "<br><br>";

// array_filter() : membuang nilai yang dianggap kosong/false
$f = array(0, 1, false, 2, "", 3, "array");
echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';
echo "Hasil array_filter: " . implode(" ", array_filter($f)) . "<br><br>";

// sort() & rsort() : array terindeks 
$g = array(3, 1, 2);
echo "Array awal: (3, 1, 2)<br>";
sort($g);                                   
echo "Hasil sort: " . implode(" ", $g) . "<br>";
rsort($g);                                 
echo "Hasil rsort: " . implode(" ", $g) . "<br><br>";

// asort(), ksort(), arsort(), krsort() : array asosiatif
$age = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';

asort($age);
echo "Hasil asort: ";
foreach ($age as $k => $v) { echo "$k=> $v, "; }
echo "<br>";

ksort($age);
echo "Hasil ksort: ";
foreach ($age as $k => $v) { echo "$k=> $v, "; }
echo "<br>";

arsort($age);                               
echo "Hasil arsort: ";
foreach ($age as $k => $v) { echo "$k=> $v, "; }
echo "<br>";

krsort($age); 
echo "Hasil krsort: ";
foreach ($age as $k => $v) { echo "$k=> $v, "; }
echo "<br>";
?>