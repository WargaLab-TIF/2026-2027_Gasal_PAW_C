<?php 
function sum($x, $y) {
	return $x + $y;
};


$a = 5;
$b = 10;
$z = sum($a, $b);
echo $a . " + " . $b . " = " . $z;

echo "<br>";

$a1 = 7;
$b1 = 13;
$z1 = sum($a1, $b1);
echo $a1 . " + " . $b1 . " = " . $z1;

echo "<br>";

$a2 = 2;
$b2 = 4;
$z2 = sum($a2, $b2);
echo $a2 . " + " . $b2 . " = " . $z2;
?>