<?php
// array_push
$a = array("A");
echo "Array awal: (\"" . $a[0] . "\")<br>";
array_push($a, "B");
echo "Hasil array_push: " . $a[0] . " " . $a[1] . "<br><br>";

// array_merge
$b = array("A", "B");
$c = array("C");
echo "Array awal: (\"" . $b[0] . "\", \"" . $b[1] . "\") digabung dengan (\"" . $c[0] . "\")<br>";
$g = array_merge($b, $c);
echo "Hasil array_merge: " . $g[0] . " " . $g[1] . " " . $g[2] . "<br><br>";

// array_values
$d = array("x" => 1, "y" => 2);
echo "Array awal: (\"x\" => " . $d["x"] . ", \"y\" => " . $d["y"] . ")<br>";
$e = array_values($d);
echo "Hasil array_values: " . $e[0] . " " . $e[1] . "<br><br>";

// array_search
$f = array("A", "B", "C");
echo "Mencari \"B\" pada array: (\"" . $f[0] . "\", \"" . $f[1] . "\", \"" . $f[2] . "\")<br>";
echo "Hasil array_search: " . array_search("B", $f) . "<br><br>";

// array_filter
$h = array(0, 1, false, 2, "", 3, "array");
echo "Array awal: (0, 1, false, 2, \"\", 3, \"array\")<br>";
$i = array_filter($h);
echo "Hasil array_filter: " . $i[1] . " " . $i[3] . " " . $i[5] . " " . $i[6] . "<br><br>";

// sort & rsort (array terindeks)
$j = array(3, 1, 2);
echo "Array awal: (" . $j[0] . ", " . $j[1] . ", " . $j[2] . ")<br>";
sort($j);
echo "Hasil sort: " . $j[0] . " " . $j[1] . " " . $j[2] . "<br>";
rsort($j);
echo "Hasil rsort: " . $j[0] . " " . $j[1] . " " . $j[2] . "<br><br>";

// asort, ksort, arsort, krsort (array asosiatif)
$age = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo "Array awal: (\"Peter\"=>" . $age["Peter"] . ", \"Ben\"=>" . $age["Ben"] . ", \"Joe\"=>" . $age["Joe"] . ")<br>";

asort($age);
echo "Hasil asort: Peter=> " . $age["Peter"] . ", Ben=> " . $age["Ben"] . ", Joe=> " . $age["Joe"] . ",<br>";

$age = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
ksort($age);
echo "Hasil ksort: Ben=> " . $age["Ben"] . ", Joe=> " . $age["Joe"] . ", Peter=> " . $age["Peter"] . ",<br>";

$age = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
arsort($age);
echo "Hasil arsort: Joe=> " . $age["Joe"] . ", Ben=> " . $age["Ben"] . ", Peter=> " . $age["Peter"] . ",<br>";

$age = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
krsort($age);
echo "Hasil krsort: Peter=> " . $age["Peter"] . ", Joe=> " . $age["Joe"] . ", Ben=> " . $age["Ben"] . ",<br>";
?>
