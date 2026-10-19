<?php
function ubah($teks,$teks2,$teks3){
    return str_replace($teks, $teks2,$teks3);
}

echo "<h1>" .ubah("world!","Dolly!","Hello world!"). "</h1>";
?>