<?php 

// Tambahkan lima data baru ke dalam array $fruits dengan menggunakan perulangan for, lalu tampilkan panjang (jumlah data) array dan array $fruits saat ini. Jelaskan apakah skrip perulangan for pada baris #5-#8 perlu diubah agar seluruh data tampil, beserta alasannya!

$fruits = array("Avocado","Blueberry","Cherry");
$arrlength = count($fruits);

$new = array("Banana", "Strawberry", "Lemon", "Kiwi", "Jackfruit");


for($x = 0; $x < count($new) ; $x++) {
    $fruits[] = $new[$x];
}

$newleght = count($fruits);
for($x = 0; $x < $newleght ; $x++) {
    echo $fruits[$x];
    echo "<br>";
}
echo "Penjelasan : <br>
		ya kode perlu dirubah, karena kondisi perulangan awal menggunakan panjang variabel arrleght hanya 3 saja, sedangkan data yang kita tambahkan ada 5 data baru, jika kita menggunakan panjang data baru saja maka hanya melakukan perulangan 5 kali. Oleh karena itu kita harus memasukkan semua data dulu ke dalam perulangan baru nanti melakukan perulangan lagi untuk mencetak hasil array baru"


 ?>