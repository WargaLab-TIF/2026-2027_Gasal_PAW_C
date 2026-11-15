<?php
include "koneksi.php";

$tanggal_mulai   = $_GET['tanggal_mulai']   ?? '';
$tanggal_selesai = $_GET['tanggal_selesai'] ?? '';

function tanggal_valid($t) {
    $d = DateTime::createFromFormat('Y-m-d', $t);
    return $d && $d->format('Y-m-d') === $t;
}

$filter_aktif = tanggal_valid($tanggal_mulai) && tanggal_valid($tanggal_selesai)
                && $tanggal_mulai <= $tanggal_selesai;

$where = $filter_aktif ? "WHERE waktu_transaksi BETWEEN ? AND ?" : "";

$stmt = mysqli_prepare($koneksi, "SELECT waktu_transaksi AS tanggal, SUM(total) AS total_harian
                                  FROM transaksi $where
                                  GROUP BY waktu_transaksi
                                  ORDER BY waktu_transaksi ASC");
if ($filter_aktif) mysqli_stmt_bind_param($stmt, "ss", $tanggal_mulai, $tanggal_selesai);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);

$stmt2 = mysqli_prepare($koneksi, "SELECT COUNT(DISTINCT pelanggan_id) AS jml_pelanggan,
                                          COALESCE(SUM(total), 0) AS total_semua
                                   FROM transaksi $where");
if ($filter_aktif) mysqli_stmt_bind_param($stmt2, "ss", $tanggal_mulai, $tanggal_selesai);
mysqli_stmt_execute($stmt2);
$ringkas = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt2));

// Header HTTP agar browser mengunduh sebagai file Excel
$nama_file = "rekap_penjualan_" . ($filter_aktif ? "{$tanggal_mulai}_sd_{$tanggal_selesai}" : "semua") . ".xls";
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$nama_file\"");
header("Pragma: no-cache");
header("Expires: 0");
?>
<html>
<head><meta charset="UTF-8"></head>
<body>
<table border="1">
    <tr><th colspan="3">Rekapitulasi Penjualan Harian</th></tr>
    <tr><td colspan="3">Periode: <?= $filter_aktif ? date('d-m-Y', strtotime($tanggal_mulai)) . " s/d " . date('d-m-Y', strtotime($tanggal_selesai)) : "Semua tanggal"; ?></td></tr>
    <tr>
        <th>No</th>
        <th>Total Pendapatan</th>
        <th>Tanggal Transaksi</th>
    </tr>
    <?php $no = 1; while ($r = mysqli_fetch_assoc($hasil)) { ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= (int) $r['total_harian']; ?></td>
        <td><?= date('d-m-Y', strtotime($r['tanggal'])); ?></td>
    </tr>
    <?php } ?>
    <tr>
        <th colspan="2">Jumlah Pelanggan Unik</th>
        <th><?= (int) $ringkas['jml_pelanggan']; ?></th>
    </tr>
    <tr>
        <th colspan="2">Total Pendapatan Keseluruhan</th>
        <th><?= (int) $ringkas['total_semua']; ?></th>
    </tr>
</table>
</body>
</html>
