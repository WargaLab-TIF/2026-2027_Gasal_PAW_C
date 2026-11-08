<?php
include "koneksi.php";

$id = $_GET['id'];

$hapus = mysqli_query($conn, "DELETE FROM supplier WHERE id='$id'");

if ($hapus) {
    echo "Data supplier berhasil dihapus!";
    echo "<br><a href='data.php'>Kembali</a>";
} else {
    echo "Data gagal dihapus!";
}
?>