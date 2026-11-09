<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_penjualan';

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
?>