<?php

function gantikata($kalimat){

	return str_replace("world", "Dolly", $kalimat);
}

$a = "Hello world!" ; 
echo gantikata($a);
?>