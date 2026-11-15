<?php
$students = [
    ["Name" => "Alex", "NIM" => "220401", "Mobile" => "0812345678"],
    ["Name" => "Bianca", "NIM" => "220402", "Mobile" => "0812345687"],
    ["Name" => "Candice", "NIM" => "220403", "Mobile" => "0812345665"]
];
echo "Data awal <br>";
echo "students = <br>";
foreach($students as $s){
    echo $s["Name"]." - ".$s["NIM"]." - ".$s["Mobile"]."<br>";
}

echo "<br>Data setelah ditambah 5 data baru <br>";
array_push($students, 
["Name" => "David", "NIM" => "220404", "Mobile" => "0812345666"],
["Name" => "Ethan", "NIM" => "220405", "Mobile" => "0812345667"],
["Name" => "Frank", "NIM" => "220406", "Mobile" => "0812345668"],
["Name" => "George", "NIM" => "220407", "Mobile" => "0812345669"],
["Name" => "Hannah", "NIM" => "220408", "Mobile" => "0812345670"]
);
foreach($students as $m){
    echo $m["Name"]." - ".$m["NIM"]." - ".$m["Mobile"]."<br>";
}
echo "<br>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";
foreach($students as $row){
    echo "<tr>";
    echo "<td>".$row['Name']."</td>";
    echo "<td>".$row['NIM']."</td>";
    echo "<td>".$row['Mobile']."</td>";
    echo "</tr>";
}
echo "</table>";
?>