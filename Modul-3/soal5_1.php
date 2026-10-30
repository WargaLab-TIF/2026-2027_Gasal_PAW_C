<?php 

// Name NIM Mobile
// Alex 220401 0812345678
// Bianca 220402 0812345687
// Candice 220403 0812345665
// Buat array multidimensi yang menyimpan data pada tabel di atas, kemudian tambah lima data yang lain, lalu tampilkan seluruhnya dalam bentuk tabel.

$student = [
	["name" => "Alex", "nim" => "22041", "mobile" => "0812345678"],
	["name" => "Bianca", "nim" => "22042", "mobile" => "0812345687"],
	["name" => "Candice", "nim" => "22043", "mobile" => "0812345665"]
];

echo "Data awal :";
echo "<br>";
echo "students = ";
var_dump($student);
echo "<br>";
echo "<br>";

$student[] = ["name" => "Daniel", "nim" => "22044", "mobile" => "0812345611"];
$student[] = ["name" => "Elena", "nim" => "22045", "mobile" => "0812345622"];
$student[] = ["name" => "Fiona", "nim" => "22046", "mobile" => "0812345633"];
$student[] = ["name" => "Gabe", "nim" => "22047", "mobile" => "0812345644"];
$student[] = ["name" => "Hannah", "nim" => "22048", "mobile" => "0812345655"];

echo "Data setelah ditambah 5 data lain :";
echo "<br>";
echo "students = ";
var_dump($student);
echo "<br>";
echo "<br>";


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title></title>s
 	<style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px 10px;
        }
    </style>
 </head>
 <body>
 	<table>
        <tr>
            <th>Name</th>
            <th>NIM</th>
            <th>Mobile</th>
        </tr>
        <?php foreach ($student as $s): ?>
        <tr>
            <td><?php echo $s["name"]; ?></td>
            <td><?php echo $s["nim"]; ?></td>
            <td><?php echo $s["mobile"]; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
 </body>
 </html>