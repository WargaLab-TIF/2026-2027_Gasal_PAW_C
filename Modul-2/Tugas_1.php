<?php

$matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL");
$praktikum = array("JARKOM", "PAW");

for ($i = 0; $i < count($matkul); $i++) {
    $adaPraktikum = false;

    for ($j = 0; $j < count($praktikum); $j++) {
        if ($matkul[$i] == $praktikum[$j]) {
            $adaPraktikum = true;
            break;
        }
    }

    if ($adaPraktikum) {
        echo "Saya sedang mengambil matkul " . $matkul[$i] . " termasuk praktikumnya" . "<br>";
    } elseif ($i == 6 || $i == 7) {
        echo "Saya belum mengambil matkul " . $matkul[$i] . " semester lalu" . "<br>";
    } else {
        echo "Saya sedang mengambil matkul " . $matkul[$i] . "<br>";
    }
}
