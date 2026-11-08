<?php
include 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];


    $q_harga = mysqli_query($conn, "SELECT harga FROM barang WHERE id = '$barang_id'");
    $b = mysqli_fetch_assoc($q_harga);
    $harga = $b['harga'];


    $insert = mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ('$transaksi_id', '$barang_id', '$harga', '$qty')");

    if($insert){
        $q_update = "
            UPDATE transaksi 
            SET total = (SELECT SUM(harga * qty) FROM transaksi_detail WHERE transaksi_id = '$transaksi_id')
            WHERE id = '$transaksi_id'
        ";
        mysqli_query($conn, $q_update);

        echo "<script>
                alert('Detail berhasil ditambahkan dan total transaksi telah diupdate.');
                window.location.href = 'index.php?transaksi_id=$transaksi_id';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambah detail.');
                window.location.href = 'index.php?transaksi_id=$transaksi_id';
              </script>";
    }
}
?>