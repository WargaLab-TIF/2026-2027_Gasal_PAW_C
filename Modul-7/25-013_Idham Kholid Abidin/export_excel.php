<?php
include 'koneksi.php';

$mulai = $_GET['mulai'] ?? '';
$selesai = $_GET['selesai'] ?? '';

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $mulai) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $selesai)) {
    die('Tanggal tidak valid.');
}

$mulai_aman = mysqli_real_escape_string($koneksi, $mulai);
$selesai_aman = mysqli_real_escape_string($koneksi, $selesai);

$query = mysqli_query($koneksi, "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian FROM transaksi WHERE waktu_transaksi BETWEEN '$mulai_aman' AND '$selesai_aman' GROUP BY DATE(waktu_transaksi) ORDER BY tgl ASC");

$ringkasan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(DISTINCT pelanggan_id) AS jml_pelanggan FROM transaksi WHERE waktu_transaksi BETWEEN '$mulai_aman' AND '$selesai_aman'"));

header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="laporan_penjualan_' . $mulai . '_' . $selesai . '.xls"');
header('Cache-Control: max-age=0');

echo '<html><head><meta charset="UTF-8"></head><body>';
echo '<table border="1" cellpadding="4" style="border-collapse: collapse;">';
echo '<tr><th colspan="3" style="width: 440px;">Laporan Penjualan ' . $mulai . ' s/d ' . $selesai . '</th></tr>';
echo '<tr><th style="width: 60px;">No</th><th style="width: 200px;">Total Pendapatan</th><th style="width: 180px;">Tanggal Transaksi</th></tr>';

$no = 1;
$total = 0;

while ($row = mysqli_fetch_assoc($query)) {
    $total += (int) $row['total_harian'];
    echo '<tr>';
    echo '<td>' . $no++ . '</td>';
    echo '<td>' . (int) $row['total_harian'] . '</td>';
    echo '<td>' . $row['tgl'] . '</td>';
    echo '</tr>';
}

echo '<tr><td colspan="2">Jumlah Pelanggan</td><td>' . (int) ($ringkasan['jml_pelanggan'] ?? 0) . '</td></tr>';
echo '<tr><td colspan="2">Jumlah Pendapatan</td><td>' . $total . '</td></tr>';
echo '</table></body></html>';
