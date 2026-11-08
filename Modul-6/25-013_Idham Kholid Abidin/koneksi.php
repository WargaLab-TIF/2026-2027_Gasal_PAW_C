<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$servername = "localhost";
$username = "root";
$password = "";
$database = "DB_praktikum";

try {
    $koneksi = mysqli_connect($servername, $username, $password, $database);
} catch (mysqli_sql_exception $e) {
    die("Koneksi database gagal. Pastikan MySQL aktif dan database DB_praktikum tersedia.");
}
?>
