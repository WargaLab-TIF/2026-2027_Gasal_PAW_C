<?php
include 'koneksi.php';
$id_barang = $_GET['id'];


$cek_query = "SELECT * FROM transaksi_detail WHERE barang_id = '$id_barang'";
$cek_result = mysqli_query($conn, $cek_query);

if(mysqli_num_rows($cek_result) > 0){
    echo "<script>
            alert('Gagal menghapus! Barang ini masih digunakan pada transaksi.');
            window.location.href = 'barang.php';
          </script>";
} else {
    $hapus_query = "DELETE FROM barang WHERE id = '$id_barang'";
    if(mysqli_query($conn, $hapus_query)){
        echo "<script>
                alert('Barang berhasil dihapus.');
                window.location.href = 'barang.php';
              </script>";
    } else {
        echo "<script>
                alert('Terjadi kesalahan saat menghapus data.');
                window.location.href = 'barang.php';
              </script>";
    }
}
?>