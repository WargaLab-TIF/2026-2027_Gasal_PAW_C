<?php

function hitungkata($kalimat){

	return str_word_count($kalimat);
}

$a = "Hello world!" ; 
echo hitungkata($a);
?>
