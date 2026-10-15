<?php

function cariposisi($kalimat){

	return strpos($kalimat, "world");
}

$a = "Hello world!" ; 
echo cariposisi($a);
?>