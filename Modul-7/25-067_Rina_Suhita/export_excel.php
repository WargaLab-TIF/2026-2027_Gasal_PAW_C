<?php
require 'koneksi.php';

$mulai   = $_GET['mulai']   ?? '';
$selesai = $_GET['selesai'] ?? '';

// Validasi rentang tanggal (sama seperti halaman laporan)
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $mulai)
    || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $selesai)
    || $mulai > $selesai) {
    http_response_code(400);
    die("Rentang tanggal tidak valid.");
}

// Data rekap harian (query sama dengan halaman laporan)
$stmt = mysqli_prepare($koneksi,
    "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian
       FROM transaksi
      WHERE waktu_transaksi BETWEEN ? AND ?
      GROUP BY DATE(waktu_transaksi)
      ORDER BY tgl ASC");
mysqli_stmt_bind_param($stmt, "ss", $mulai, $selesai);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);
$rekap = [];
while ($r = mysqli_fetch_assoc($hasil)) {
    $rekap[] = $r;
}

// Ringkasan kumulatif
$stmt2 = mysqli_prepare($koneksi,
    "SELECT COUNT(DISTINCT pelanggan_id) AS jml_pelanggan,
            COALESCE(SUM(total), 0) AS total_semua
       FROM transaksi
      WHERE waktu_transaksi BETWEEN ? AND ?");
mysqli_stmt_bind_param($stmt2, "ss", $mulai, $selesai);
mysqli_stmt_execute($stmt2);
$ringkasan = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt2));

// HTTP response header: memberi tahu browser bahwa isinya Excel dan harus diunduh
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="rekap_penjualan_' . $mulai . '_sd_' . $selesai . '.xls"');
header("Pragma: no-cache");
header("Expires: 0");
?>
<html>
<head><meta charset="UTF-8"></head>
<body>
  <h3>Rekap Laporan Penjualan <?= h($mulai) ?> sampai <?= h($selesai) ?></h3>
  <table border="1">
    <tr><th>No</th><th>Total Pendapatan (Rp)</th><th>Tanggal Transaksi</th></tr>
    <?php $no = 1; foreach ($rekap as $row): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= (int)$row['total_harian'] ?></td>
        <td><?= h(date('d M Y', strtotime($row['tgl']))) ?></td>
      </tr>
    <?php endforeach; ?>
    <?php if (empty($rekap)): ?>
      <tr><td colspan="3">Tidak ada transaksi pada rentang tanggal ini.</td></tr>
    <?php endif; ?>
  </table>
  <br>
  <table border="1">
    <tr><th>Jumlah Pelanggan Unik</th><td><?= (int)$ringkasan['jml_pelanggan'] ?></td></tr>
    <tr><th>Total Pendapatan Keseluruhan (Rp)</th><td><?= (int)$ringkasan['total_semua'] ?></td></tr>
  </table>
</body>
</html>