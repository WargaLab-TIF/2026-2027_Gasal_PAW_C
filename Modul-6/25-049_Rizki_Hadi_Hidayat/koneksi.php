<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_tugas_praktikum";

$conn = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_error()) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>