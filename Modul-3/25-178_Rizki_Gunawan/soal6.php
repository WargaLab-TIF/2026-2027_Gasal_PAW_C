<?php
$a = ["A"]; array_push($a, "B");
echo "Array awal: (\"A\")<br>Hasil array_push: ".implode(" ", $a)."<br><br>";

$a1 = ["A","B"]; $a2 = ["C"]; $m = array_merge($a1,$a2);
echo "Array awal: (\"A\", \"B\") digabung dengan (\"C\")<br>Hasil array_merge: ".implode(" ", $m)."<br><br>";

$arr = ["x"=>1,"y"=>2]; $v = array_values($arr);
echo "Array awal: (\"x\" => 1, \"y\" => 2)<br>Hasil array_values: ".implode(" ", $v)."<br><br>";

$s = ["A","B","C"];
echo "Mencari \"B\" pada array: (\"A\", \"B\", \"C\")<br>Hasil array_search: ".array_search("B",$s)."<br><br>";

$f = [0,1,false,2,"",3,"array"]; $fil = array_filter($f);
echo "Array awal: (0, 1, false, 2, \"\", 3, \"array\")<br>Hasil array_filter: ".implode(" ", $fil)."<br><br>";

$num = [3,1,2]; sort($num); $s1 = implode(" ", $num);
$num = [3,1,2]; rsort($num); $s2 = implode(" ", $num);
echo "Array awal: (3, 1, 2)<br>Hasil sort: $s1<br>Hasil rsort: $s2<br><br>";

$umur = ["Peter"=>35,"Ben"=>37,"Joe"=>43];
asort($umur); echo "Array awal: (\"Peter\"=>35, \"Ben\"=>37, \"Joe\"=>43)<br>";
foreach($umur as $k=>$val) echo "Hasil asort: ";;
foreach($umur as $k=>$val) { echo "$k=> $val "; } echo "<br>";

ksort($umur); echo "Hasil ksort: "; foreach($umur as $k=>$v) echo "$k=> $v "; echo "<br>";
arsort($umur); echo "Hasil arsort: "; foreach($umur as $k=>$v) echo "$k=> $v "; echo "<br>";
krsort($umur); echo "Hasil krsort: "; foreach($umur as $k=>$v) echo "$k=> $v "; 
?>