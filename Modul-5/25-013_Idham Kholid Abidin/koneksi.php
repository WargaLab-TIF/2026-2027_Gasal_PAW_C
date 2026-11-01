<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "DB_praktikum";

try {
    $koneksi = mysqli_connect($servername, $username, $password, $database);
} catch (mysqli_sql_exception $e) {
    die("koneksi gagal : " . $e->getMessage());
}
?>
