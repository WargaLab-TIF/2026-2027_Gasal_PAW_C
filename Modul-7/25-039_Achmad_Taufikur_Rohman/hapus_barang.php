<?php
include "koneksi.php";

$id = $_POST['id'];

$query = mysqli_query($koneksi, "SELECT * FROM transaksi_detail
                                 WHERE barang_id = '$id'");

if (mysqli_num_rows($query) > 0) {
    header("Location: barang.php?pesan=digunakan");
    exit;
} else {
    $query = mysqli_query($koneksi, "DELETE FROM barang WHERE id = '$id'");

    if ($query) {
        header("Location: barang.php?pesan=berhasil");
        exit;
    } else {
        header("Location: barang.php?pesan=gagal");
        exit;
    }
}
?>