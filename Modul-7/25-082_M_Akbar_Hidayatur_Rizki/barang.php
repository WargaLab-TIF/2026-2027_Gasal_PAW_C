<?php
include 'koneksi.php';

$notifikasi = null;

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id_barang = $_GET['id'];
    $notifikasi = hapus_barang($koneksi, $id_barang);
}

$daftar_barang = get_barang($koneksi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Barang - Modul 6</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding: 30px;
        }
        .card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            width: 80%;
            margin: auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: darkcyan;
            color: white;
            text-align: center;
        }
        .btn-hapus {
            background-color: #DC2626;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
        }
        .btn-hapus:hover {
            background-color: #B91C1C;
        }
        .btn-kembali {
            display: inline-block;
            background-color: #6B7280;
            color: white;
            padding: 7px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Master Data Barang</h2>

    <?php if ($notifikasi): ?>
        <?php if ($notifikasi['status'] === true): ?>
            <div style="color: green;"> <?= $notifikasi['pesan']; ?></div>
        <?php else: ?>
            <div style="color: red;"><?= $notifikasi['pesan']; ?></div>
        <?php endif; ?>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($b = mysqli_fetch_assoc($daftar_barang)): ?>
                <tr>
                    <td align="center"><?= $no++; ?>.</td>
                    <td><?= $b['kode_barang']; ?></td>
                    <td><?= $b['nama_barang']; ?></td>
                    <td>Rp <?= number_format($b['harga'], 0, ',', '.'); ?></td>
                    <td align="center"><?= $b['stok']; ?></td>
                    <td align="center">
                        <a href="barang.php?aksi=hapus&id=<?= $b['id']; ?>" 
                           class="btn-hapus"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus barang <?= $b['nama_barang']; ?>?')">
                           Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="master-detail.php" class="btn-kembali">Kembali</a>
</div>

</body>
</html>