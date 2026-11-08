<?php
require "koneksi.php";

$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

if ($id <= 0) {
    header("Location: barang.php");
    exit;
}

$cek = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM transaksi_detail WHERE barang_id = $id");
$hasil = mysqli_fetch_assoc($cek);

if ($hasil["jumlah"] > 0) {
    header("Location: barang.php?status=dipakai");
    exit;
}

mysqli_query($conn, "DELETE FROM barang WHERE id = $id");

header("Location: barang.php?status=hapus");
exit;
?>
