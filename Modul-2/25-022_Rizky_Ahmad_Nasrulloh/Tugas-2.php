<?php
$matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL");

foreach ($matkul as $m) {
    switch ($m) {
        case "PTI":
        case "ALPRO":
        case "DPW":
        case "STRUKDAT":
        case "JARKOM":
        case "PAW":
            echo "Saya suka " . $m . "<br>";
            break;
        default:
            echo "Saya tidak mengambil matkul " . $m . "<br>";
            break;
    }
}
?>