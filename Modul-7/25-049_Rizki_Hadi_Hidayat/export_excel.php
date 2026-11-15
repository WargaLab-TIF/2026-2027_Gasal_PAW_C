<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjualan7");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$mulai = $_GET['mulai'] ?? '';
$selesai = $_GET['selesai'] ?? '';

if (empty($mulai) || empty($selesai)) {
    die("Rentang tanggal tidak valid.");
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Penjualan_$mulai-sampai-$selesai.xls");
header("Pragma: no-cache");
header("Expires: 0");

$q = "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian 
      FROM transaksi 
      WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai' 
      GROUP BY DATE(waktu_transaksi) 
      ORDER BY tgl ASC";
$res = mysqli_query($koneksi, $q);

$qp = "SELECT COUNT(DISTINCT pelanggan_id) AS jml, SUM(total) AS total_pendapatan 
      FROM transaksi 
      WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'";
$rp = mysqli_fetch_assoc(mysqli_query($koneksi, $qp));
$total_pelanggan = $rp['jml'] ?? 0;
$total_pendapatan = $rp['total_pendapatan'] ?? 0;
?>
<center>
    <h3>Rekap Laporan Penjualan (<?= $mulai ?> s.d. <?= $selesai ?>)</h3>
</center>
<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Total Pendapatan</th>
            <th>Tanggal Transaksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1; 
        while ($row = mysqli_fetch_assoc($res)): 
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td>Rp. <?= number_format($row['total_harian'], 0, ',', '.'); ?></td>
            <td><?= $row['tgl']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">
                <b>Jumlah Pelanggan Unik:</b> <?= $total_pelanggan; ?> Orang | 
                <b>Jumlah Pendapatan Keseluruhan:</b> Rp. <?= number_format($total_pendapatan, 0, ',', '.'); ?>
            </td>
        </tr>
    </tfoot>
</table>