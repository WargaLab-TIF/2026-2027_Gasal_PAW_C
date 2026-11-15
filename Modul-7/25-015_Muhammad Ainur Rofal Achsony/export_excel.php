<?php
require 'koneksi.php';

$ambil = mysqli_query($conn, "SELECT MIN(waktu_transaksi) AS awal, MAX(waktu_transaksi) AS akhir FROM transaksi");
if (!$ambil) {
    die("Query gagal: " . mysqli_error($conn));
}
$rentang = mysqli_fetch_assoc($ambil);
$akhir = $rentang['akhir'];

$default_mulai = date('Y-m-01', strtotime($akhir));
$mulai = isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : $default_mulai;
$selesai = isset($_GET['tanggal_selesai']) ? $_GET['tanggal_selesai'] : $akhir;

if (!is_string($mulai) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $mulai)) {
    $mulai = $default_mulai;
}
if (!is_string($selesai) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $selesai)) {
    $selesai = $akhir;
}
if ($mulai > $selesai) {
    $tukar = $mulai;
    $mulai = $selesai;
    $selesai = $tukar;
}

$rekap = array();

$query = "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian
          FROM transaksi
          WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
          GROUP BY DATE(waktu_transaksi)
          ORDER BY tgl ASC";
$hasil = mysqli_query($conn, $query);
if (!$hasil) {
    die("Query gagal: " . mysqli_error($conn));
}
while ($row = mysqli_fetch_assoc($hasil)) {
    $rekap[] = $row;
}

$query = "SELECT COUNT(DISTINCT pelanggan_id) AS jml
          FROM transaksi
          WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'";
$hasil = mysqli_query($conn, $query);
if (!$hasil) {
    die("Query gagal: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($hasil);
$total_pelanggan = (int) $row['jml'];

$query = "SELECT SUM(total) AS total
          FROM transaksi
          WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'";
$hasil = mysqli_query($conn, $query);
if (!$hasil) {
    die("Query gagal: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($hasil);
$total_pendapatan = (int) $row['total'];

$namaFile = 'laporan_penjualan_' . $mulai . '_sd_' . $selesai . '.xls';

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=" . $namaFile);
header("Pragma: no-cache");
header("Expires: 0");

echo "\xEF\xBB\xBF";
?>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <table border="1">
        <tr>
            <th colspan="3">Laporan Penjualan</th>
        </tr>
        <tr>
            <td colspan="3">Periode: <?= $mulai ?> s.d. <?= $selesai ?></td>
        </tr>
        <tr>
            <th>No</th>
            <th>Total Pendapatan</th>
            <th>Tanggal Transaksi</th>
        </tr>
        <?php
        $no = 1;
        foreach ($rekap as $row) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>Rp " . number_format((int) $row['total_harian'], 0, ',', '.') . "</td>";
            echo "<td>" . $row['tgl'] . "</td>";
            echo "</tr>";
            $no++;
        }
        ?>
        <tr>
            <td colspan="2">Jumlah Pelanggan Unik</td>
            <td><?= $total_pelanggan ?></td>
        </tr>
        <tr>
            <td colspan="2">Total Pendapatan Keseluruhan</td>
            <td>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></td>
        </tr>
    </table>
</body>
</html>

