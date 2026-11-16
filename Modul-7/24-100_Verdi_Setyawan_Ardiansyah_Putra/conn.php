<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "kampusdb";

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>