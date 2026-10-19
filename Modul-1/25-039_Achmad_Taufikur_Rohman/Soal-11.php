<?php
function cari($teks,$teks2){
    return strpos($teks, $teks2);
}

echo "<h1>" .cari("Hello world!","world"). "</h1>";
?>