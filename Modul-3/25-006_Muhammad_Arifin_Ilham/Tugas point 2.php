<!-- Tugas Point 2 -->
<?php
// Soal Utama: Panjang array dan akses array terindeks dengan perulangan
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

// 2.1. Menambahkan 5 data baru ke dalam array $fruits dengan perulangan
//JAWABAN ANALISIS SOAL 2.1:
// Skrip perulangan for untuk menampilkan data perlu disesuaikan dengan memperbarui nilai variabel $arrlength menggunakan count($fruits) setelah proses penambahan data
// * Alasan: Karena jumlah elemen array bertambah dari 3 menjadi 8, maka batas maksimal perulangan for harus diperbarui agar seluruh data (termasuk buah tambahan) dapat tertampilkan dengan lengkap
for ($i = 1; $i <= 5; $i++) {
    array_push($fruits, "Buah Tambahan " . $i);
}


$arrlength = count($fruits);

echo "Panjang array saat ini: " . $arrlength . "<br><br>";

for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x] . "<br>";
}

echo "<hr>";

/**
 * 2.2 Membuat array baru bernama $vegies dan menampilkan seluruh datanya
 * 
 * JAWABAN ANALISIS SOAL 2.2:
 * Kita membuat blok skrip baru (bukan memakai variabel $fruits sebelumnya)
 * Alasan: Agar data sayuran terpisah dari array buah dan tidak saling menimpa data, sehingga hasil keluaran bisa menampilkan data sayuran secara spesifik  sesuai instruksi soal
 **/

$vegies = array("Carrot", "Broccoli", "Spinach");
$veglength = count($vegies);

for ($y = 0; $y < $veglength; $y++) {
    echo $vegies[$y] . "<br>";
}
?>
