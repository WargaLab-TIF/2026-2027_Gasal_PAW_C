<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "penjualan";

$conn = mysqli_connect($host, $user, $pass, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error() . ". Jalankan database.php terlebih dahulu.");
}
?>
