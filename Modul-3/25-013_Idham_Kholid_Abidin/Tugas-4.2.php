<?php
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");
$keys = array_keys($weight);

for($i = 0; $i < count($weight); $i++){
	echo $keys[$i], " is ", $weight[$keys[$i]], " kg.";
	echo "<br>";
}
?>
