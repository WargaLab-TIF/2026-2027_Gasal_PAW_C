<?php
$matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL");
$praktikum = array("JARKOM", "PAW");

for ($i = 0; $i < count($matkul); $i++) {
    // Mengecek apakah data matkul sama dengan data praktikum
    if (in_array($matkul[$i], $praktikum)) {
        echo "Saya sedang mengambil matkul " . $matkul[$i] . " termasuk praktikum nya<br>";
    } 
    // Mengecek jika data matkul berada pada indeks 6 atau 7
    elseif ($i == 6 || $i == 7) {
        echo "Saya belum mengambil matkul " . $matkul[$i] . "<br>";
    } 
    // Jika tidak memenuhi kondisi mana pun
    else {
        echo "Saya sudah mengambil matkul " . $matkul[$i] . " semester lalu<br>";
    }
}
?>