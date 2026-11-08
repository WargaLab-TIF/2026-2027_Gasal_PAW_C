<?php
include 'koneksi.php';
$q_transaksi = mysqli_query($koneksi, "SELECT t.*, p.nama AS nama_pelanggan FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id = p.id ORDER BY t.id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f4f6f9; }
        .container { max-width: 900px; margin: auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #2c3e50; color: white; }
        a { text-decoration: none; color: #3498db; font-weight: bold; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
    <h2>Daftar Master Transaksi</h2>
    <p>Silakan pilih transaksi untuk mengelola detailnya:</p>
    <table>
        <tr>
            <th>ID Transaksi</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
        <?php while ($t = mysqli_fetch_assoc($q_transaksi)): ?>
        <tr>
            <td>#<?= $t['id']; ?></td>
            <td><?= $t['waktu_transaksi']; ?></td>
            <td><?= htmlspecialchars($t['nama_pelanggan'] ?? 'Umum'); ?></td>
            <td>Rp <?= number_format($t['total'], 0, ',', '.'); ?></td>
            <td><a href="master_detail.php?id=<?= $t['id']; ?>">Kelola Detail &raquo;</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="barang.php">&laquo; Kelola Data Barang</a>
</div>
</body>
</html>