<?php
    $matkul = [
        "PTI", "ALPRO", "DPW", "STRUKDAT",
        "JARKOM", "PAW", "PSBF", "RPL"
    ];

    foreach ($matkul as $alias) {
        switch ($alias) {
            case 'PTI':
                echo "Saya suka " . $alias . "<br>" ;
                break;
            case 'ALPRO':
                echo "Saya suka " . $alias . "<br>";
                break;
            case 'DPW':
                echo "Saya suka " . $alias . "<br>";
                break;
            case 'STRUKDAT':
                echo "Saya suka " . $alias . "<br>";
                break;
            case 'JARKOM':
                echo "Saya suka " . $alias . "<br>";
                break;
            case 'PAW':
                echo "Saya suka " . $alias . "<br>";
                break;
            default:
                echo "Saya tidak mengambil matkul " . $alias . "<br>";
                break;                 
        }
    }
?>