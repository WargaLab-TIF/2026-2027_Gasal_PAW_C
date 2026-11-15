
<?php
include "koneksi.php";

if (
    !isset($_POST['transaksi_id'], $_POST['barang_id']) ||
    !is_numeric($_POST['transaksi_id']) ||
    !is_numeric($_POST['barang_id'])
) {
    die("Data tidak valid.");
}

$id = (int) $_POST['transaksi_id'];
$barang_id = (int) $_POST['barang_id'];

mysqli_begin_transaction($koneksi);

$query = mysqli_query($koneksi, "DELETE FROM transaksi_detail
                                 WHERE transaksi_id = '$id'
                                 AND barang_id = '$barang_id'");

if ($query && mysqli_affected_rows($koneksi) > 0) {
    $query = mysqli_query($koneksi, "UPDATE transaksi SET total = (
                                     SELECT COALESCE(SUM(harga * qty), 0)
                                     FROM transaksi_detail
                                     WHERE transaksi_id = '$id'
                                     )
                                     WHERE id = '$id'");

    if ($query) {
        mysqli_commit($koneksi);
        header("Location: detail.php?id=$id&pesan=dihapus");
        exit;
    } else {
        mysqli_rollback($koneksi);
        echo "Gagal memperbarui total transaksi.";
    }
} else {
    mysqli_rollback($koneksi);
    echo "Gagal menghapus detail transaksi atau barang tidak ditemukan.";
}
?>