<?php
$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";
print_r($height);
echo "<br>";
$keys = array_keys($height);
$last = end($keys);
echo "Nilai dengan indeks terakhir adalah : ", $height[$last];
echo "<br>";
echo "<br>";
$hapus = "Barry";
unset($height[$hapus]);
echo "Data ", $hapus, " Dihapus dalam array";
echo "<br>";
print_r($height);
echo "<br>";
$keys = array_keys($height);
$last = end($keys);
echo "Nilai dengan indeks terakhir adalah : ", $height[$last];
?>
