<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";
echo 'height = ("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170", "David"=>"180", "Ethan"=>"172", "Frank"=>"168", "George"=>"175", "Harry"=>"182")';
echo "<br><br>";
foreach($height as $name => $cm){
    echo "$name is $cm cm tall <br>";
}
echo "<br>";
echo "<br>";
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");
echo 'weight = ("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75")';
$keys = array_keys($weight);
for($i = 0; $i < count($weight); $i++){
    echo $keys[$i] . " is " . $weight[$keys[$i]] . " kg. <br>";
}
?>