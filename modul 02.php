<?php
echo "<h2>SOAL 1: IF, ELSEIF, ELSE & FOR</h2>";

$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
$praktikum = ["JARKOM", "PAW"];

for ($i = 0; $i < count($matkul); $i++) {
    if (in_array($matkul[$i], $praktikum)) {
        echo "Saya sedang mengambil matkul " . $matkul[$i] . " termasuk praktikumnya.<br>";
    } elseif ($i == 6 || $i == 7) {
        echo "Saya belum mengambil matkul " . $matkul[$i] . ".<br>";
    } else {
        echo "Saya sudah mengambil matkul " . $matkul[$i] . " semester lalu.<br>";
    }
}

echo "<hr>";

echo "<h2>SOAL 2: FOREACH & SWITCH</h2>";

foreach ($matkul as &$namaMatkul) {
    switch ($namaMatkul) {
        case "PTI":
            echo "Saya suka PTI<br>";
            break;

        case "ALPRO":
            echo "Saya suka ALPRO<br>";
            break;

        case "DPW":
            echo "Saya suka DPW<br>";
            break;

        case "STRUKDAT":
            echo "Saya suka STRUKDAT<br>";
            break;

        case "JARKOM":
            echo "Saya suka JARKOM<br>";
            break;

        case "PAW":
            echo "Saya suka PAW<br>";
            break;

        default:
            echo "Saya tidak mengambil matkul " . $namaMatkul . "<br>";
    }
}

unset($namaMatkul);

echo "<hr>";

echo "<h2>SOAL 3: DO WHILE</h2>";

$angka = 0;

do {
    echo $angka . "<br>";
    $angka += 4;
} while ($angka <= 20);
?>
