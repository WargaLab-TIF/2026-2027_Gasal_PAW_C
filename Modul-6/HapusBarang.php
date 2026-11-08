<?php
include 'koneksi.php';

$id_barang = $_GET['id'];
$cek_ada = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE barang_id = '$id_barang'");

if (mysqli_num_rows($cek_ada) > 0) {
    echo "<script>alert('Barang tidak bisa dihapus karena masih digunakan di transaksi!'); window.location='data_barang.php';</script>";
} else {
    mysqli_query($conn, "DELETE FROM barang WHERE id = '$id_barang'");
    echo "<script>alert('Data barang berhasil dihapus!'); window.location='data_barang.php';</script>";
}
?>