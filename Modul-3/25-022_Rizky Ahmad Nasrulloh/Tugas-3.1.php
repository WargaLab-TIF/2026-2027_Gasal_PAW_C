<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
$height += array("David"=>"180", "Ethan"=>"172", "Frank"=>"168", "George"=>"175", "Harry"=>"182");

// Tampil semua data
echo "height = (";
foreach($height as $k => $v) { echo '"'.$k.'"=>"'.$v.'", '; }
echo ")<br>";

// Menampilkan nilai indeks terakhir
echo "Nilai dengan indeks terakhir: " . end($height) . "<br>";

// Hapus satu data (misal Barry)
unset($height['Barry']);
echo "Nilai dengan indeks terakhir setelah dihapus: " . end($height) . "<br>";
?>