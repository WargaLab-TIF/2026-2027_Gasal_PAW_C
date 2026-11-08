<?php 
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

print_r($weight);
echo "<br>";
for ($i = 0; $i < 3; $i++) {
    if ($i == 0) {
        echo "Andy is " . $weight["Andy"] . "<br>";
    } elseif ($i == 1) {
        echo "Barry is " . $weight["Barry"] . "<br>";
    } else {
        echo "Charlie is " . $weight["Charlie"] . "<br>";
    }
}
?>