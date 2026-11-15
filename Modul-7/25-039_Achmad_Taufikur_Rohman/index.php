<?php
include "koneksi.php";

$query = mysqli_query($koneksi, "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total,
                                 p.nama AS nama_pelanggan,
                                 COUNT(td.barang_id) AS jumlah_jenis_barang
                                 FROM transaksi t
                                 JOIN pelanggan p ON p.id = t.pelanggan_id
                                 LEFT JOIN transaksi_detail td ON td.transaksi_id = t.id
                                 GROUP BY t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama
                                 ORDER BY t.id ASC");

if (!$query) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<h2>Data Master Transaksi</h2>
<table border="1">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Jenis Barang</th>
        <th>Action</th>
    </tr>

    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?= $data['id']; ?></td>
        <td><?= $data['waktu_transaksi']; ?></td>
        <td><?= htmlspecialchars($data['nama_pelanggan']); ?></td>
        <td><?= htmlspecialchars($data['keterangan'] ?? '-'); ?></td>
        <td>Rp <?= number_format($data['total'], 0, ',', '.'); ?></td>
        <td><?= $data['jumlah_jenis_barang']; ?></td>
        <td>
            <a href="detail.php?id=<?= $data['id']; ?>">Detail</a>
        </td>
    </tr>
    <?php } ?>
</table>

<a href="barang.php">Detail Barang</a> |
<a href="laporan.php">Laporan Penjualan</a>