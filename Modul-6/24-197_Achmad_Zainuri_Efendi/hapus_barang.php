<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    $cek_penggunaan = mysqli_query($conn, "SELECT id FROM transaksi_detail WHERE barang_id = '$id_barang' LIMIT 1");

    if (mysqli_num_rows($cek_penggunaan) > 0) {
        echo "<script>
                alert('Gagal! Data barang ini tidak boleh dihapus karena masih digunakan pada data transaksi.');
                window.location.href='data_barang.php';
              </script>";
    } else {
        mysqli_query($conn, "DELETE FROM barang WHERE id = '$id_barang'");
        echo "<script>
                alert('Berhasil! Data barang telah dihapus.');
                window.location.href='data_barang.php';
              </script>";
    }
}
?>