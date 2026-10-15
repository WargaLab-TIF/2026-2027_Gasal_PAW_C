<?php
$students = array(
    array("Name" => "Alex", "NIM" => "220401", "Mobile" => "0812345678"),
    array("Name" => "Bianca", "NIM" => "220402", "Mobile" => "0812345687"),
    array("Name" => "Candice", "NIM" => "220403", "Mobile" => "0812345665")
);

// Menambahkan 5 data baru
$new_students = array(
    array("Name" => "Daniel", "NIM" => "220404", "Mobile" => "0812345611"),
    array("Name" => "Elena", "NIM" => "220405", "Mobile" => "0812345622"),
    array("Name" => "Fiona", "NIM" => "220406", "Mobile" => "0812345633"),
    array("Name" => "Gabe", "NIM" => "220407", "Mobile" => "0812345644"),
    array("Name" => "Hannah", "NIM" => "220408", "Mobile" => "0812345655")
);
$students = array_merge($students, $new_students);

// Menampilkan dalam bentuk tabel HTML
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";

foreach($students as $s) {
    echo "<tr>";
    echo "<td>" . $s['Name'] . "</td>";
    echo "<td>" . $s['NIM'] . "</td>";
    echo "<td>" . $s['Mobile'] . "</td>";
    echo "</tr>";
}
echo "</table>";
?> 