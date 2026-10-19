<?php
function jumlahkata($a = ""){
    return str_word_count($a);
}

echo "<h1>" . jumlahkata("Hello world!") . "</h1>";
?>