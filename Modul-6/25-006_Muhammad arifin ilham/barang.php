<?php
include 'koneksi.php';

// Proses Hapus Barang dengan Validasi Relasi
if (isset($_GET['hapus_id'])) {
    $barang_id = intval($_GET['hapus_id']);

    // Periksa apakah barang sudah digunakan pada tabel transaksi_detail
    $cek = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM transaksi_detail WHERE barang_id = $barang_id");
    $data_cek = mysqli_fetch_assoc($cek);

    if ($data_cek['total'] > 0) {
        echo "<script>alert('Gagal Hapus! Barang tersebut masih digunakan pada transaksi.'); window.location='barang.php';</script>";
    } else {
        mysqli_query($koneksi, "DELETE FROM barang WHERE id = $barang_id");
        echo "<script>alert('Data barang berhasil dihapus.'); window.location='barang.php';</script>";
    }
}

$result_barang = mysqli_query($koneksi, "SELECT b.*, s.nama AS nama_supplier FROM barang b LEFT JOIN supplier s ON b.supplier_id = s.id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Barang</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f4f6f9; }
        .container { max-width: 900px; margin: auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #34495e; color: white; }
        a.btn-del { color: red; text-decoration: none; font-weight: bold; }
        .nav-link { margin-bottom: 15px; display: inline-block; }
    </style>
</head>
<body>
<div class="container">
    <h2>Data Barang & Validasi Hapus</h2>
    <a href="master.php" class="nav-link">&laquo; Kembali ke Daftar Master Transaksi</a>
    <table>
        <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>
        <?php while ($b = mysqli_fetch_assoc($result_barang)): ?>
        <tr>
            <td><?= $b['kode_barang']; ?></td>
            <td><?= htmlspecialchars($b['nama_barang']); ?></td>
            <td>Rp <?= number_format($b['harga'], 0, ',', '.'); ?></td>
            <td><?= $b['stok']; ?></td>
            <td><?= htmlspecialchars($b['nama_supplier'] ?? '-'); ?></td>
            <td>
                <a href="barang.php?hapus_id=<?= $b['id']; ?>" class="btn-del" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>