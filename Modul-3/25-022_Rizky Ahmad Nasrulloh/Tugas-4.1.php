<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170", "David"=>"180", "Ethan"=>"172", "Frank"=>"168", "George"=>"175", "Harry"=>"182");
unset($height['Barry']);

foreach($height as $name => $h) {
    echo $name . " is " . $h . " cm tall.<br>";
}
?>