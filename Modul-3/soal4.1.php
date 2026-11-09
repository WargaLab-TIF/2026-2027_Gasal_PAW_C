php
<?php
$height = array(
    "Andy" => 176,
    "Barry" => 165,
    "Charlie" => 170
);

// Menambahkan lima data baru
$height["David"] = 180;
$height["Ethan"] = 172;
$height["Frank"] = 168;
$height["George"] = 175;
$height["Harry"] = 182;

// Menampilkan seluruh data menggunakan perulangan
echo 'height = ';
print_r($height);
echo "<br><br>";

foreach ($height as $name => $tall) {
    echo "$name is $tall cm tall.<br>";
}
?>
```