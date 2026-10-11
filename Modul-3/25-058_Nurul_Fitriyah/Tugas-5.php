<!-- soal 5.1 -->
<?php  
// $mh = array(
// 	array("Alex", "220401", "0812345678"),
// 	array("Bianca", "220402", "0812345687"),
// 	array("Candice", "220403", "0812345665")
// );

// array_push($mh, array("Daniel", "220404", "0812345611"));
// array_push($mh, array("Elena", "220405", "0812345622"));
// array_push($mh, array("Fiona", "220406", "0812345633"));
// array_push($mh, array("Gabe", "220407", "0812345644"));
// array_push($mh, array("Hannah", "220408", "0812345655"));

// echo "<table border='1' cellpadding='5' cellspasing='0'>";
// echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";

// for ($row=0; $row < count($mh) ; $row++) { 
// 	echo "<tr>";
// 	for ($col=0; $col < 3; $col++) { 
// 		echo "<td>" . $mh[$row][$col] . "</td>";
// 	}
// 	echo "</tr>";
// }
// echo "</table>";

// Data awal (3 mahasiswa pertama)
echo "Data awal:<br>";
echo "students = (<br>";
echo '&nbsp;&nbsp;&nbsp;&nbsp;("Alex", "220401", "0812345678"),<br>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;("Bianca", "220402", "0812345687"),<br>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;("Candice", "220403", "0812345665")<br>';
echo ")<br><br>";

$mh = array(
	array("Alex", "220401", "0812345678"),
	array("Bianca", "220402", "0812345687"),
	array("Candice", "220403", "0812345665")
);

// Menambahkan 5 data lain menggunakan array_push()
array_push($mh, array("Daniel", "220404", "0812345611"));
array_push($mh, array("Elena", "220405", "0812345622"));
array_push($mh, array("Fiona", "220406", "0812345633"));
array_push($mh, array("Gabe", "220407", "0812345644"));
array_push($mh, array("Hannah", "220408", "0812345655"));

// Menampilkan teks data setelah ditambah
echo "Data setelah ditambah 5 data lain:<br>";
echo "students = (<br>";
echo '&nbsp;&nbsp;&nbsp;&nbsp;("Alex", "220401", "0812345678"),<br>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;("Bianca", "220402", "0812345687"),<br>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;("Candice", "220403", "0812345665"),<br>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;("Daniel", "220404", "0812345611"),<br>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;("Elena", "220405", "0812345622"),<br>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;("Fiona", "220406", "0812345633"),<br>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;("Gabe", "220407", "0812345644"),<br>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;("Hannah", "220408", "0812345655")<br>';
echo ")<br><br>";

// Menampilkan hasil dalam bentuk tabel
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";

for ($row=0; $row < count($mh) ; $row++) { 
	echo "<tr>";
	for ($col=0; $col < 3; $col++) { 
		echo "<td>" . $mh[$row][$col] . "</td>";
	}
	echo "</tr>";
}
echo "</table>";
?>
