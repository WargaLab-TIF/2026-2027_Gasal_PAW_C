<?php
function tampilStudents($students) {
    $baris = array();
    foreach ($students as $s) {
        $baris[] = '("' . $s[0] . '", "' . $s[1] . '", "' . $s[2] . '")';
    }
    echo "students = (<br>" . implode(",<br>", $baris) . "<br>)<br><br>";
}

$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

echo "Data awal:<br>";
tampilStudents($students);

$students[] = array("Daniel", "220404", "0812345611");
$students[] = array("Elena", "220405", "0812345622");
$students[] = array("Fiona", "220406", "0812345633");
$students[] = array("Gabe", "220407", "0812345644");
$students[] = array("Hannah", "220408", "0812345655");

echo "Data setelah ditambah 5 data lain:<br>";
tampilStudents($students);

echo '<table border="1" cellpadding="3" cellspacing="0">';
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
for ($i = 0; $i < count($students); $i++) {
    echo "<tr>";
    for ($j = 0; $j < 3; $j++) {
        echo "<td>" . $students[$i][$j] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>