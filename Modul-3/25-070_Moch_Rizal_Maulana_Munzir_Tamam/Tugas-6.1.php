<?php
$a = array("A");
echo 'Array awal: ("A")<br>';
array_push($a, "B");
echo 'Hasil array_push: A B<br><br>';

$a = array("A", "B");
$b = array("C");
echo 'Array awal: ("A", "B") digabung dengan ("C")<br>';
$c = array_merge($a, $b);
echo 'Hasil array_merge: ';
foreach ($c as $isi) {
    echo $isi . " ";
}

echo '<br><br>';

$a = array("x" => 1, "y" => 2);
echo 'Array awal: ("x" => 1, "y" => 2)<br>';
echo 'Hasil array_values: ';
foreach (array_values($a) as $isi) {
    echo $isi . " ";
}

echo '<br><br>';

$a = array("A", "B", "C");
echo 'Mencari "B" pada array: ("A", "B", "C")<br>';
echo 'Hasil array_search: ' . array_search("B", $a);

echo '<br><br>';

$a = array(0, 1, false, 2, "", 3, "array");
echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';
echo 'Hasil array_filter: ';
foreach (array_filter($a) as $isi) {
    echo $isi . " ";
}

echo '<br><br>';

$a = array(3, 1, 2);
echo 'Array awal: (3, 1, 2)<br>';
sort($a);
echo 'Hasil sort: ';
foreach ($a as $isi) {
    echo $isi . " ";
}

$a = array(3, 1, 2);
rsort($a);
echo '<br>Hasil rsort: ';
foreach ($a as $isi) {
    echo $isi . " ";
}

echo '<br><br>';

$a = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';

$a = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
asort($a);
echo 'Hasil asort: ';
foreach ($a as $nama => $umur) {
    echo "$nama => $umur, ";
}

$a = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
arsort($a);
echo '<br>Hasil arsort: ';
foreach ($a as $nama => $umur) {
    echo "$nama => $umur, ";
}

$a = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
ksort($a);
echo '<br>Hasil ksort: ';
foreach ($a as $nama => $umur) {
    echo "$nama => $umur, ";
}

$a = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
krsort($a);
echo '<br>Hasil krsort: ';
foreach ($a as $nama => $umur) {
    echo "$nama => $umur, ";
}
?>