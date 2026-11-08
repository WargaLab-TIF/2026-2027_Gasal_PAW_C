<?php

$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
$praktikum = ["JARKOM", "PAW",];

$jumlah_matkul = count($matkul);

for ($i = 0; $i < $jumlah_matkul; $i++) {
	// pakek function built in bernama in_array yang mana fungsinya itu untuk mengecek apakah ada nilai tertentu dalam target(array), jika ada maka true, jika tidak maka false.
    if (in_array($matkul[$i], $praktikum)) {
        echo "Saya sedang mengambil matkul " . $matkul[$i] . " termasuk praktikumnya<br>";
    } elseif ($i == 6 || $i == 7) {
        echo "Saya belum mengambil matkul " . $matkul[$i] . "<br>";
    } else {
        echo "Saya sudah mengambil matkul " . $matkul[$i] . " semester lalu<br>";
    }
}

?>
