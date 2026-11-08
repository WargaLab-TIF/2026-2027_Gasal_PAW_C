<?php
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

$transaksi_id = isset($_POST["transaksi_id"]) ? (int) $_POST["transaksi_id"] : 0;
$barang_id = isset($_POST["barang_id"]) ? (int) $_POST["barang_id"] : 0;
$qty = isset($_POST["qty"]) ? (int) $_POST["qty"] : 0;

if ($transaksi_id <= 0 || $barang_id <= 0 || $qty <= 0) {
    header("Location: index.php?id=$transaksi_id&pesan=gagal");
    exit;
}

$cekDetail = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM transaksi_detail
                                  WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id");
$hasilCek = mysqli_fetch_assoc($cekDetail);

if ($hasilCek["jumlah"] > 0) {
    header("Location: index.php?id=$transaksi_id&pesan=dobel");
    exit;
}

$ambilBarang = mysqli_query($conn, "SELECT harga FROM barang WHERE id = $barang_id");
$barang = mysqli_fetch_assoc($ambilBarang);

if (!$barang) {
    header("Location: index.php?id=$transaksi_id&pesan=gagal");
    exit;
}

$harga = (int) $barang["harga"];

$simpan = mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                               VALUES ($transaksi_id, $barang_id, $harga, $qty)");

if (!$simpan) {
    header("Location: index.php?id=$transaksi_id&pesan=gagal");
    exit;
}

mysqli_query($conn, "UPDATE transaksi
                     SET total = (
                         SELECT SUM(harga * qty)
                         FROM transaksi_detail
                         WHERE transaksi_id = $transaksi_id
                     )
                     WHERE id = $transaksi_id");

header("Location: index.php?id=$transaksi_id&pesan=tambah");
exit;
?>
