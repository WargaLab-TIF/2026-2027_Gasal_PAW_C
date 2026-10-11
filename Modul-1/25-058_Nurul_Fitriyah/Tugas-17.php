<?php  
function sum($x, $y, $a=0) {
	$z = $x + $y + $a;
	echo "$x + $y + $a = $z <br>";
}

sum(5, 10, 2) ;
sum(7, 13) ;
sum(2, 4, 1);
?>