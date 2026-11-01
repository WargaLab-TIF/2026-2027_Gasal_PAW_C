<?php

$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];

$praktikum = ["JARKOM", "PAW"];

foreach ($matkul as $index => $namaMatkul) {

    if (in_array($namaMatkul, $praktikum)) {
        echo "Saya sedang mengambil matkul $namaMatkul termasuk praktikumnya<br>";

    } elseif ($index == 6 || $index == 7) {
        echo "Saya belum mengambil matkul $namaMatkul<br>";

    } else {
        echo "Saya sudah mengambil matkul $namaMatkul semester lalu<br>";
    }
}

?>