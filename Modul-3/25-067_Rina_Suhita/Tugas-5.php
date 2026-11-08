<?php
function tampilStudents($arr) {
    echo "students = (<br>";
    $total = count($arr);
    foreach ($arr as $i => $row) {
        echo '("' . $row[0] . '", "' . $row[1] . '", "' . $row[2] . '")';
        if ($i < $total - 1) {
            echo ",";
        }
        echo "<br>";
    }
    echo ")<br>";
}

// 5.1 Array multidimensi dari tabel (Name, NIM, Mobile), lalu menambah lima data lain, dan menampilkan seluruh data dalam bentuk tabel
$students = array(
    array("Alex",    "220401", "0812345678"),
    array("Bianca",  "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

echo "Data awal:<br>";
tampilStudents($students);

echo "<br>";

$students[] = array("Daniel", "220404", "0812345611");
$students[] = array("Elena",  "220405", "0812345622");
$students[] = array("Fiona",  "220406", "0812345633");
$students[] = array("Gabe",   "220407", "0812345644");
$students[] = array("Hannah", "220408", "0812345655");

echo "Data setelah ditambah 5 data lain:<br>";
tampilStudents($students);

echo "<br>";

echo "<table border='1'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
foreach ($students as $row) {
    echo "<tr>";
    echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "</td>";
    echo "<td>" . $row[2] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>