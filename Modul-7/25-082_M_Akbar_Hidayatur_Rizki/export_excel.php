<?php
include 'koneksi.php';

$tglAwal = $_GET['tglAwal'] ?? '';
$tglAkhir = $_GET['tglAkhir'] ?? '';

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Laporan_Penjualan_" . date('Ymd_His') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

$namaBulan = [
    1=>'Januari', 
    2=>'Februari', 
    3=>'Maret', 
    4=>'April', 
    5=>'Mei', 
    6=>'Juni',
    7=>'Juli', 
    8=>'Agustus', 
    9=>'September', 
    10=>'Oktober', 
    11=>'November', 
    12=>'Desember'
];

if (!empty($tglAwal) && !empty($tglAkhir)) {
    $query = "
        SELECT
            MONTH(waktu_transaksi) AS bulan,
            DAY(waktu_transaksi) AS tanggal,
            YEAR(waktu_transaksi) AS tahun,
            COUNT(id) AS total_transaksi,
            SUM(total) AS total_pendapatan
        FROM transaksi
        WHERE waktu_transaksi BETWEEN ? AND ?
        GROUP BY DAY(waktu_transaksi), MONTH(waktu_transaksi), YEAR(waktu_transaksi)
        ORDER BY tahun ASC, bulan ASC, tanggal ASC
    ";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $tglAwal, $tglAkhir);
    $stmt->execute();
    $hasil = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $queryP = "
        SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan, SUM(total) AS total_pendapatan
        FROM transaksi
        WHERE waktu_transaksi BETWEEN ? AND ?
    ";
    
    $stmt1 = $koneksi->prepare($queryP);
    $stmt1->bind_param("ss", $tglAwal, $tglAkhir);
    $stmt1->execute();
    $hasil1 = $stmt1->get_result()->fetch_assoc();
} else {
    $query = "
        SELECT
            MONTH(waktu_transaksi) AS bulan,
            DAY(waktu_transaksi) AS tanggal,
            YEAR(waktu_transaksi) AS tahun,
            COUNT(id) AS total_transaksi,
            SUM(total) AS total_pendapatan
        FROM transaksi
        GROUP BY DAY(waktu_transaksi), MONTH(waktu_transaksi), YEAR(waktu_transaksi)
        ORDER BY tahun ASC, bulan ASC, tanggal ASC
    ";
    $hasil = mysqli_query($koneksi, $query);

    $queryP = "
        SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan, SUM(total) AS total_pendapatan
        FROM transaksi
    ";
    $hasil1 = mysqli_fetch_assoc(mysqli_query($koneksi, $queryP));
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan Excel</title>
</head>
<body>
    <h3>LAPORAN PENJUALAN</h3>
    <?php if (!empty($tglAwal) && !empty($tglAkhir)): ?>
        <p>Periode: <b><?= htmlspecialchars($tglAwal) ?></b> s/d <b><?= htmlspecialchars($tglAkhir) ?></b></p>
    <?php else: ?>
        <p>Periode: <b>Semua Transaksi</b></p>
    <?php endif; ?>

    <table border="1" cellpadding="5">
        <thead>
            <tr style="background-color: #6D28D9; color: #FFFFFF; font-weight: bold; text-align: center;">
                <th>No</th>
                <th>Tanggal Transaksi</th>
                <th>Total Transaksi</th>
                <th>Total Pendapatan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($hasil as $d): ?>
                <tr>
                    <td align="center"><?= $no++ ?>.</td>
                    <td><?= $d["tanggal"] . ' ' . $namaBulan[(int)$d["bulan"]] . ' ' . $d["tahun"] ?></td>
                    <td align="center"><?= $d["total_transaksi"] ?></td>
                    <td align="right"><?= $d["total_pendapatan"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

    <table border="1" cellpadding="5">
        <thead>
            <tr style="background-color: #6D28D9; color: #FFFFFF; font-weight: bold; text-align: center;">
                <th>Jumlah Pelanggan Unik</th>
                <th>Total Pendapatan Keseluruhan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center"><?= $hasil1['jumlah_pelanggan'] ?? 0 ?></td>
                <td align="right"><?= $hasil1['total_pendapatan'] ?? 0 ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>