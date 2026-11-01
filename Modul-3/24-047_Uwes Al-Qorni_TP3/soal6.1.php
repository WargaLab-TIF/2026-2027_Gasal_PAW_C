<?php
$arr = array("A");
echo 'Array awal: ("A")<br>';
array_push($arr, "B");
echo "Hasil array_push: " . implode(" ", $arr) . "<br><br>";

$a1 = array("A", "B");
$a2 = array("C");
echo 'Array awal: ("A", "B") digabung dengan ("C")<br>';
$gabung = array_merge($a1, $a2);
echo "Hasil array_merge: " . implode(" ", $gabung) . "<br><br>";

$assoc = array("x" => 1, "y" => 2);
echo 'Array awal: ("x" => 1, "y" => 2)<br>';
$nilai = array_values($assoc);
echo "Hasil array_values: " . implode(" ", $nilai) . "<br><br>";

$cari = array("A", "B", "C");
echo 'Mencari "B" pada array: ("A", "B", "C")<br>';
echo "Hasil array_search: " . array_search("B", $cari) . "<br><br>";

$campur = array(0, 1, false, 2, "", 3, "array");
echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';
$bersih = array_filter($campur);
echo "Hasil array_filter: " . implode(" ", $bersih) . "<br><br>";

$angka = array(3, 1, 2);
echo "Array awal: (3, 1, 2)<br>";
$a = $angka;
sort($a);
echo "Hasil sort: " . implode(" ", $a) . "<br>";
$b = $angka;
rsort($b);
echo "Hasil rsort: " . implode(" ", $b) . "<br><br>";

function cetak($arr) {
    foreach ($arr as $k => $v) {
        echo $k . "=> " . $v . ", ";
    }
}

$umur = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';

$c = $umur; asort($c);
echo "Hasil asort: "; cetak($c); echo "<br>";

$d = $umur; ksort($d);
echo "Hasil ksort: "; cetak($d); echo "<br>";

$e = $umur; arsort($e);
echo "Hasil arsort: "; cetak($e); echo "<br>";

$f = $umur; krsort($f);
echo "Hasil krsort: "; cetak($f); echo "<br>";
?>