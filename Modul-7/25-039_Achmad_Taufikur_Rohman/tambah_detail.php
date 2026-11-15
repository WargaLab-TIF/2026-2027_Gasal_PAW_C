<?php
include "koneksi.php";

$id = $_POST['transaksi_id'];
$barang_id = $_POST['barang_id'];
$qty = $_POST['qty'];

if ($qty < 1) {
    header("Location: detail.php?id=$id");
    exit;
}

$query = mysqli_query($koneksi, "SELECT * FROM transaksi
                                 WHERE id = '$id'");

if (!mysqli_fetch_assoc($query)) {
    die("Transaksi tidak ditemukan.");
}

$query = mysqli_query($koneksi, "SELECT * FROM barang
                                 WHERE id = '$barang_id'");

$barang = mysqli_fetch_assoc($query);

if (!$barang) {
    die("Barang tidak ditemukan.");
}

$query = mysqli_query($koneksi, "SELECT * FROM transaksi_detail
                                 WHERE transaksi_id = '$id'
                                 AND barang_id = '$barang_id'");

if (mysqli_num_rows($query) > 0) {
    header("Location: detail.php?id=$id&pesan=duplikat");
    exit;
}

$harga = $barang['harga'];

mysqli_begin_transaction($koneksi);

$query = mysqli_query($koneksi, "INSERT INTO transaksi_detail
                                 (transaksi_id, barang_id, harga, qty)
                                 VALUES ('$id', '$barang_id', '$harga', '$qty')");

if ($query) {
    // Menghitung ulang total transaksi dari seluruh detail.
    $query = mysqli_query($koneksi, "UPDATE transaksi SET total = (
                                     SELECT COALESCE(SUM(harga * qty), 0)
                                     FROM transaksi_detail
                                     WHERE transaksi_id = '$id'
                                     )
                                     WHERE id = '$id'");

    if ($query) {
        mysqli_commit($koneksi);
        header("Location: detail.php?id=$id&pesan=ditambahkan");
        exit;
    } else {
        mysqli_rollback($koneksi);
        echo "Gagal memperbarui total transaksi.";
    }
} else {
    mysqli_rollback($koneksi);
    echo "Gagal menambahkan detail transaksi.";
}
?>