<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
$height += [
    "David"=>"180", 
    "Ethan"=>"172", 
    "Frank"=>"168", 
    "George"=>"175", 
    "Harry"=>"182"
];

echo "height = (";
$out = [];
foreach($height as $k => $v) { $out[] = "\"$k\"=>\"$v\""; }
echo implode(", ", $out) . ")<br>";

foreach($height as $name => $h) {
    echo "$name is $h cm tall.<br>";
}
echo "<br>";

$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

echo "weight = (";
$out_w = [];
foreach($weight as $k => $v) { $out_w[] = "\"$k\"=>\"$v\""; }
echo implode(", ", $out_w) . ")<br>";

$w_keys = array_keys($weight);
$w_len = count($weight);

for($i = 0; $i < $w_len; $i++) {
    $current_key = $w_keys[$i];
    echo "$current_key is " . $weight[$current_key] . " kg.<br>";
}
?>