<?php
$students = [
    ["Name" => "Alex", "NIM" => "220401", "Mobile" => "0812345678"],
    ["Name" => "Bianca", "NIM" => "220402", "Mobile" => "0812345687"],
    ["Name" => "Candice", "NIM" => "220403", "Mobile" => "0812345665"]
];

array_push($students,
    ["Name" => "Daniel", "NIM" => "220404", "Mobile" => "0812345611"],
    ["Name" => "Elena", "NIM" => "220405", "Mobile" => "0812345622"],
    ["Name" => "Fiona", "NIM" => "220406", "Mobile" => "0812345633"],
    ["Name" => "Gabe", "NIM" => "220407", "Mobile" => "0812345644"],
    ["Name" => "Hannah", "NIM" => "220408", "Mobile" => "0812345655"]
);

echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr>
        <th>Name</th>
        <th>NIM</th>
        <th>Mobile</th>
      </tr>";

foreach($students as $student) {
    echo "<tr>
            <td>{$student['Name']}</td>
            <td>{$student['NIM']}</td>
            <td>{$student['Mobile']}</td>
          </tr>";
}
echo "</table>";
?>