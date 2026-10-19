<?php
$matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
$praktikum = ["JARKOM","PAW"];

for ($i = 0 ; $i < 8 ; $i++) {
    $sama = false;
    for ($j = 0; $j < 2; $j++){
        if ($matkul[$i] == $praktikum[$j]) {
            $sama = true;
        }
    }
    if ($sama){
        echo "Saya sedang mengambil mata kuliah ".$matkul[$i]. "<br>";
    }else if ($i == 6 || $i ==7){
        echo "Saya belum mengambil matkul " . $matkul[$i] ."<br>";
    }else {
        echo "Saya sudah mengambil mata kuliah " . $matkul[$i]. " semester lalu" . "<br>"; 
    }
}
?>