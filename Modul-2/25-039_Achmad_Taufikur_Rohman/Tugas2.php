<?php
$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
foreach ($matkul as $a) {
    switch ($a) {
        case "PTI":
        case "ALPRO":
        case "DPW":
        case "STRUKDAT":
        case "JARKOM":
        case "PAW":
            echo "Saya suka " . $a . "<br>";
            break;
        case "PSBF":
        case "RPL":
            echo "Saya tidak mengambil matkul " . $a . "<br>";
    }
}
?>