<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "penjualan7";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>