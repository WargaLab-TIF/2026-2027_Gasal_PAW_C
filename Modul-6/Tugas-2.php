
<?php
include __DIR__ . '/koneksi.php';

$data = mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama 
FROM transaksi 
JOIN pelanggan ON pelanggan.id = transaksi.pelanggan_id");

if (!$data) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<style>
a, a:visited {
    color: blue;
}
</style>

<h2>Data Transaksi</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>

    <?php while ($r = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $r['id'] ?></td>
        <td><?= $r['waktu_transaksi'] ?></td>
        <td><?= $r['nama'] ?></td>
        <td><?= $r['keterangan'] ?></td>
        <td><?= $r['total'] ?></td>
        <td>
            <a href="detail.php?id=<?= $r['id'] ?>">Detail</a>
        </td>
    </tr>
    <?php } ?>
</table>
