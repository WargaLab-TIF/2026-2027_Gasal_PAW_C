<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $hapus = mysqli_query($koneksi, "DELETE FROM supplier WHERE id = '$id'");
    if ($hapus) {
        header("Location: index.php");
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='index.php';</script>";
    }
} else {
    header("Location: index.php");
}
?>