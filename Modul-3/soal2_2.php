<?php 

//Buat array baru bernama $vegies yang memiliki tiga data, lalu tampilkan seluruh datanya dengan perulangan for. Jelaskan apakah Anda membuat skrip baru atau cukup memodifikasi skrip yang sudah ada, beserta alasannya!

$vegies = array("Carrot","Brocolli","Spinach");
$arrlength = count($vegies);
for($x = 0; $x < $arrlength; $x++) {
	echo $vegies[$x];
	echo "<br>";
	}

echo "Penjelasan : <br>
		ya hanya perlu dimodifikasi saja terutama pada nama variabel, karena kali ini hanya menampilkan satu variabel saja jadi untuk panjang indeks nya sudah konstan dan tidak perlu dilakukan perubahan lain"

 ?>