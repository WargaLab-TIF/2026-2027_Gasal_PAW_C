<?php
require 'koneksi.php';

$id = (int)$_GET['id'];

$stmt = mysqli_prepare($koneksi, "DELETE FROM supplier WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
} else {
    if (mysqli_errno($koneksi) == 1451) {
        $pesan = "Supplier tidak bisa dihapus karena masih dipakai oleh data barang.";
    } else {
        $pesan = "Gagal menghapus data.";
    }
    echo "<script>alert('$pesan'); window.location='index.php';</script>";
}
exit;