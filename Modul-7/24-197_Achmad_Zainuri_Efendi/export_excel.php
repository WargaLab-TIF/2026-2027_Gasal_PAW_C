<?php
include 'koneksi.php';

$tanggal_mulai   = isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : date('Y-m-01');
$tanggal_selesai = isset($_GET['tanggal_selesai']) ? $_GET['tanggal_selesai'] : date('Y-m-d');

$tgl_mulai_safe   = mysqli_real_escape_string($koneksi, $tanggal_mulai);
$tgl_selesai_safe = mysqli_real_escape_string($koneksi, $tanggal_selesai);

$nama_file = "Rekap_Penjualan_" . $tanggal_mulai . "_sd_" . $tanggal_selesai . ".xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$nama_file\"");
header("Pragma: no-cache");
header("Expires: 0");

$sql_harian = "SELECT waktu_transaksi, SUM(total) AS total_harian 
               FROM transaksi 
               WHERE waktu_transaksi BETWEEN '$tgl_mulai_safe' AND '$tgl_selesai_safe'
               GROUP BY waktu_transaksi 
               ORDER BY waktu_transaksi ASC";
$res_harian = mysqli_query($koneksi, $sql_harian);

$sql_ringkasan = "SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan, 
                         COALESCE(SUM(total), 0) AS total_keseluruhan 
                  FROM transaksi 
                  WHERE waktu_transaksi BETWEEN '$tgl_mulai_safe' AND '$tgl_selesai_safe'";
$res_ringkasan = mysqli_query($koneksi, $sql_ringkasan);
$ringkasan     = mysqli_fetch_assoc($res_ringkasan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Export Rekapitulasi Penjualan</title>
</head>
<body>
    <h3>LAPORAN REKAPITULASI PENJUALAN</h3>
    <p>Periode: <?= date('d/m/Y', strtotime($tanggal_mulai)) ?> s/d <?= date('d/m/Y', strtotime($tanggal_selesai)) ?></p>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr bgcolor="#d9edf7">
                <th>No</th>
                <th>Total Pendapatan</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($res_harian) > 0): ?>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($res_harian)): ?>
                    <tr>
                        <td align="center"><?= $no++ ?></td>
                        <td align="right">Rp <?= number_format($row['total_harian'], 0, ',', '.') ?></td>
                        <td align="center"><?= date('d-m-Y', strtotime($row['waktu_transaksi'])) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" align="center">Tidak ada data transaksi pada periode ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr bgcolor="#f2f2f2">
                <th colspan="2" align="left">Jumlah Pelanggan Unik</th>
                <th align="center"><?= number_format($ringkasan['jumlah_pelanggan'], 0, ',', '.') ?> Pelanggan</th>
            </tr>
            <tr bgcolor="#dff0d8">
                <th colspan="2" align="left">Total Pendapatan Keseluruhan</th>
                <th align="right">Rp <?= number_format($ringkasan['total_keseluruhan'], 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
</body>
</html>