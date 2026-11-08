<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
$nama = array("David", "Ethan", "Frank", "George", "Harry");
$tinggi = array("180", "172", "168", "175", "182");

for ($i = 0; $i < 5; $i++) {
    $height[$nama[$i]] = $tinggi[$i];
}
print_r($height);
echo "<br>";

foreach ($height as $nama => $tinggi) {
    echo $nama . " is " . $tinggi . " cm tall.<br>";
}
?>