<?php
include 'koneksi.php';

$waktu_transaksi = $_POST['waktu_transaksi'];
$keterangan = $_POST['keterangan'];
$pelanggan_id = $_POST['pelanggan_id'];

$query_master = "INSERT INTO transaksi (waktu_transaksi, keterangan, pelanggan_id) 
                 VALUES ('$waktu_transaksi', '$keterangan', '$pelanggan_id')";
mysqli_query($conn, $query_master);

$transaksi_id = mysqli_insert_id($conn);

$barang_id = $_POST['barang_id'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];

for ($i = 0; $i < count($barang_id); $i++) {
    $b_id = $barang_id[$i];
    $h = $harga[$i];
    $q = $qty[$i];
    
    mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) 
                         VALUES ('$transaksi_id', '$b_id', '$h', '$q')");
}

echo "<script>
        alert('Transaksi berhasil disimpan! Total terhitung otomatis oleh sistem.');
        window.location.href='tambah_transaksi.php';
      </script>";
?>