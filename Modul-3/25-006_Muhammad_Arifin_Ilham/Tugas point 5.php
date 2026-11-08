<!-- Tugas Point 5 -->
<?php
// 5.1. Membuat array multidimensi dengan data awal
$students = array(
    array("Alex", "220401", "0812348678"),
    array("Bianca", "220402", "0812348687"),
    array("Candice", "220403", "0812345668")
);

// Menampilkan teks "Data awal:" dan format array-nya
echo "Data awal:<br>";
echo "students = [ <br>";
foreach ($students as $row) {
    echo '(&quot;' . implode('&quot;, &quot;', $row) . '&quot;),<br>';
}
echo "]<br><br>";

// Menambahkan 5 data baru ke dalam array $students
array_push($students, 
    array("Daniel", "220404", "0812345611"),
    array("Elena", "220405", "0812345622"),
    array("Fiona", "220406", "0812345633"),
    array("Gabe", "220407", "0812345644"),
    array("Hannah", "220408", "0812345658")
);

// Menampilkan teks setelah ditambah 5 data dan format array-nya
echo "Data setelah ditambah 5 data lain:<br>";
echo "students = [ <br>";
foreach ($students as $row) {
    echo '(&quot;' . implode('&quot;, &quot;', $row) . '&quot;),<br>';
}
echo "]<br><br>";

// Menampilkan seluruh data ke dalam bentuk tabel HTML
echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<thead>';
echo '<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>';
echo '</thead>';
echo '<tbody>';

foreach ($students as $student) {
    echo '<tr>';
    echo '<td>' . $student[0] . '</td>';
    echo '<td>' . $student[1] . '</td>';
    echo '<td>' . $student[2] . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
?>