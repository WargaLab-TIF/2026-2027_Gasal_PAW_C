<?php
$data = [
    ["Alex", "220401", "0812345678"],
    ["Bianca", "220402", "0812345687"],
    ["Candice", "220403", "0812345665"]
];

echo "Data awal:<br>";
foreach ($data as $isi) {
    echo '("' . $isi[0] . '", "' . $isi[1] . '", "' . $isi[2] . '")<br>';
}

$data[] = ["Daniel", "220404", "0812345611"];
$data[] = ["Elena", "220405", "0812345622"];
$data[] = ["Fiona", "220406", "0812345633"];
$data[] = ["Gabe", "220407", "0812345644"];
$data[] = ["Hannah", "220408", "0812345655"];

echo "<br>Data setelah ditambah 5 data lain:<br>";
foreach ($data as $isi) {
    echo '("' . $isi[0] . '", "' . $isi[1] . '", "' . $isi[2] . '")<br>';
}

echo "<br><table border='1'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";

foreach ($data as $isi) {
    echo "<tr><td>" . $isi[0] . "</td>";
    echo "<td>" . $isi[1] . "</td>";
    echo "<td>" . $isi[2] . "</td></tr>";
}

echo "</table>";
?>