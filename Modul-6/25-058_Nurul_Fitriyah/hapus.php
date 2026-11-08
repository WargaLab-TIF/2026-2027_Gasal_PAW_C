<?php
// barang.php
include 'koneksi.php';

$notifikasi = "";

// PROSES HAPUS DATA BARANG DENGAN VALIDASI INTEGRITAS (Soal No 3)
if (isset($_GET['hapus_id'])) {
    $id_barang_hapus = intval($_GET['hapus_id']);
    
    // 1. Cek apakah barang sudah digunakan di transaksi_detail
    $cek_relasi = mysqli_query($koneksi, "SELECT id FROM transaksi_detail WHERE barang_id = $id_barang_hapus LIMIT 1");
    
    if (mysqli_num_rows($cek_relasi) > 0) {
        // Gagal hapus karena data terikat (Restrict manual)
        $notifikasi = "<div style='color: red; padding: 10px; border: 1px solid red; background: #fee;'>⚠️ Data tidak boleh dihapus! Barang tersebut masih digunakan dalam transaksi.</div>";
    } else {
        // Aman dihapus
        mysqli_query($koneksi, "DELETE FROM barang WHERE id = $id_barang_hapus");
        $notifikasi = "<div style='color: green; padding: 10px; border: 1px solid green; background: #efe;'>✅ Data barang berhasil dihapus.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Master Data Barang</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid #aaa; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2>Master Data Barang</h2>
    
    <!-- Area Notifikasi Validasi -->
    <?= $notifikasi; ?>

    <table>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        $q_barang = mysqli_query($koneksi, "SELECT * FROM barang");
        while ($b = mysqli_fetch_assoc($q_barang)) {
            echo "<tr>";
            echo "<td>" . $b['kode_barang'] . "</td>";
            echo "<td>" . $b['nama_barang'] . "</td>";
            echo "<td>Rp " . number_format($b['harga'], 0, ',', '.') . "</td>";
            echo "<td>" . $b['stok'] . "</td>";
            echo "<td><a href='barang.php?hapus_id=" . $b['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus barang ini?\")' style='color: red;'>Hapus</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    
    <p><a href="transaksi.php">Menuju Halaman Transaksi Master-Detail</a></p>

</body>
</html>