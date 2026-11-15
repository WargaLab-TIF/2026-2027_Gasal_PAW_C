<?php
include 'koneksi.php';

// $id = $_GET['id'];
// $query = "DELETE FROM supplier WHERE id = $id";

// if (mysqli_query($koneksi, $query)) {
//     header("Location: tabel.php");
//     exit;
// } else {
//     echo "Gagal menghapus data: " . mysqli_error($koneksi);
// }

if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];
   
    $stmt_cek = $koneksi->prepare("SELECT COUNT(*) FROM transaksi_detail WHERE barang_id = ?");
    $stmt_cek->execute([$id_barang]);
    $jumlah_pakai = $stmt_cek->get_result()->fetch_all();

    if ($jumlah_pakai > 0) {
        
        $pesan = "Gagal menghapus! Data barang masih digunakan pada transaksi dan tidak boleh dihapus.";
        $tipe_alert = "danger";
    } else {
        
        $stmt_hapus = $pdo->prepare("DELETE FROM barang WHERE id = ?");
        $stmt_hapus->execute([$id_barang]);
        $pesan = "Data barang berhasil dihapus.";
        $tipe_alert = "success";
    }
} else {
    header("Location: barang.php");
    exit;
}
?>