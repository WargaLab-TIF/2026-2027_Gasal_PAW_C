<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_transaksi = $_POST['transaksi_id'];
    $id_barang    = $_POST['barang_id'];
    $jumlah       = $_POST['qty'];
    $sql_harga   = mysqli_query($conn, "SELECT harga FROM barang WHERE id = '$id_barang'");
    $data_harga  = mysqli_fetch_array($sql_harga);
    $harga_satuan = $data_harga['harga'];
    $simpan_detail = mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ('$id_transaksi', '$id_barang', '$harga_satuan', '$jumlah')");

    if ($simpan_detail) {
        $sql_total   = mysqli_query($conn, "SELECT SUM(harga * qty) AS total_akhir FROM transaksi_detail WHERE transaksi_id = '$id_transaksi'");
        $data_total  = mysqli_fetch_array($sql_total);
        $total_akhir = $data_total['total_akhir'];
        mysqli_query($conn, "UPDATE transaksi SET total = '$total_akhir' WHERE id = '$id_transaksi'");

        echo "Data barang berhasil ditambahkan!<br><br>";
        echo "<a href='detail.php?id=" . $id_transaksi . "'>Kembali ke Detail Transaksi</a>";

    } else {
        echo "Gagal simpan detail: " . mysqli_error($conn) . "<br><br>";
        echo "<a href='detail.php?id=" . $id_transaksi . "'>Kembali</a>";
    }

} else {
    echo "Form belum dikirim dengan benar!<br><br>";
    echo "<a href='index.php'>Kembali ke Utama</a>";
}
?>