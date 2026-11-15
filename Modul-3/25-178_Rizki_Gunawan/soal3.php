<?php 
$height = [
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
];
$height["George"] = "175";
$height["Harry"] = "182";
$height["Ivy"] = "168";
$height["Jack"] = "180";
$height["Kevin"] = "177";
$height["Kevin"] = "177";
echo "3.1 <br>";
echo "Nilai data terakhir dari array height adalah ".var_dump($height). end($height) . "<br>";
unset($height["Charlie"]);
echo "Nilai data terakhir dari array height setelah dihapus adalah ".var_dump($height). end($height) . "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "3.2 <br>";
$weight = [
    "Andy" => "70",
    "Barry" => "65",
    "Charlie" => "75"
];
echo 'weight = ("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75")';
echo "<br>";
echo "Data kedua: ". $weight["Barry"];
?>