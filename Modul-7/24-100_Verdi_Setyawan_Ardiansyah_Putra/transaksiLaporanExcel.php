<?php
require_once __DIR__ . '/conn.php';

$tanggalMulai = $_GET['tanggal_mulai'] ?? '';
$tanggalSelesai = $_GET['tanggal_selesai'] ?? '';
$filter = false;

function tanggalValidExcel($tanggal)
{
    $hasil = DateTime::createFromFormat('!Y-m-d', $tanggal);
    return $hasil && $hasil->format('Y-m-d') === $tanggal;
}

if ($tanggalMulai != '' && $tanggalSelesai != '') {
    if (!tanggalValidExcel($tanggalMulai) || !tanggalValidExcel($tanggalSelesai)) {
        die('Format tanggal tidak valid. Silakan kembali ke halaman laporan.');
    }

    if ($tanggalMulai > $tanggalSelesai) {
        die('Tanggal mulai tidak boleh lebih besar dari tanggal selesai.');
    }

    $filter = true;
} elseif ($tanggalMulai != '' || $tanggalSelesai != '') {
    die('Tanggal mulai dan tanggal selesai harus diisi.');
}

$sql = "SELECT tanggal, SUM(total) AS pendapatan FROM transaksi";

if ($filter) {
    $sql .= " WHERE tanggal BETWEEN ? AND ?";
}

$sql .= " GROUP BY tanggal ORDER BY tanggal ASC";

if ($filter) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $tanggalMulai, $tanggalSelesai);
    $stmt->execute();
    $hasil = $stmt->get_result();
} else {
    $hasil = $conn->query($sql);
}

if (!$hasil) {
    die('Query ekspor gagal: ' . $conn->error);
}

$transaksi = $hasil->fetch_all(MYSQLI_ASSOC);

$sqlRingkasan = "SELECT COUNT(DISTINCT pelanggan) AS jumlah_pelanggan,
COALESCE(SUM(total), 0) AS total_pendapatan FROM transaksi";

if ($filter) {
    $sqlRingkasan .= " WHERE tanggal BETWEEN ? AND ?";
    $stmtRingkasan = $conn->prepare($sqlRingkasan);
    $stmtRingkasan->bind_param('ss', $tanggalMulai, $tanggalSelesai);
    $stmtRingkasan->execute();
    $hasilRingkasan = $stmtRingkasan->get_result();
} else {
    $hasilRingkasan = $conn->query($sqlRingkasan);
}

if (!$hasilRingkasan) {
    die('Query ringkasan ekspor gagal: ' . $conn->error);
}

$ringkasan = $hasilRingkasan->fetch_assoc();
$totalPelanggan = $ringkasan['jumlah_pelanggan'] ?? 0;
$totalPendapatan = $ringkasan['total_pendapatan'] ?? 0;

header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename="laporan_penjualan.xls"');
header('Cache-Control: max-age=0');
header('Pragma: no-cache');
echo "\xEF\xBB\xBF";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
</head>
<body>
    <h2>Laporan Penjualan</h2>

    <?php if ($filter): ?>
        <p>Periode: <?= date('d-m-Y', strtotime($tanggalMulai)); ?> sampai
            <?= date('d-m-Y', strtotime($tanggalSelesai)); ?></p>
    <?php else: ?>
        <p>Periode: Semua tanggal</p>
    <?php endif; ?>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Total Pendapatan (Rp)</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($transaksi)): ?>
                <tr>
                    <td colspan="3">Belum ada data transaksi.</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; ?>
                <?php foreach ($transaksi as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= (float) $row['pendapatan']; ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <br>

    <table border="1">
        <tr>
            <th>Jumlah Pelanggan Unik</th>
            <th>Total Pendapatan Keseluruhan (Rp)</th>
        </tr>
        <tr>
            <td><?= (int) $totalPelanggan; ?></td>
            <td><?= (float) $totalPendapatan; ?></td>
        </tr>
    </table>
</body>
</html>