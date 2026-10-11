<?php  
$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
$praktikum = ["JARKOM", "PAW"];

$jumlah_matkul = count($matkul);

for ($i = 0; $i < $jumlah_matkul; $i++) {
	if (in_array($matkul[$i], $praktikum)) {
		echo "Saya sedang mengambil matkul " . $matkul[$i] . " termasuk praktikum nya<br>";
	}

	elseif ($i == 6 || $i == 7) {
		echo "Saya belum mengambil matkul " . $matkul[$i] . "<br>";
	}

	else {
		echo "Saya sudah mengambil matkul " . $matkul[$i] . " semester lalu<br>";
	}
}
?>