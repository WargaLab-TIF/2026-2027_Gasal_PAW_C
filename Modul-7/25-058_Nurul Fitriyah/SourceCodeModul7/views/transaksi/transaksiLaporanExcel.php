<?php
require "../../conn.php";

$tglAwal = $_GET['tglAwal'] ?? '';
$tglAkhir = $_GET['tglAkhir'] ?? '';

if (empty($tglAwal) || empty($tglAkhir)) {
    die("Parameter tanggal mulai dan tanggal selesai tidak ditemukan.");
}

$transaksi = [];
$totalPelanggan = 0;
$totalPendapatanKeseluruhan = 0;

try {
    // Query rekap harian
    $sql = "SELECT tanggal, SUM(total) AS total_pendapatan 
            FROM transaksi 
            WHERE tanggal BETWEEN ? AND ? 
            GROUP BY tanggal 
            ORDER BY tanggal ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $tglAwal, $tglAkhir);
    $stmt->execute();
    $transaksi = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Query pelanggan unik
    $sqlPelanggan = "SELECT COUNT(DISTINCT pelanggan) AS jml_pelanggan 
                     FROM transaksi 
                     WHERE tanggal BETWEEN ? AND ?";
    $stmtP = $conn->prepare($sqlPelanggan);
    $stmtP->bind_param("ss", $tglAwal, $tglAkhir);
    $stmtP->execute();
    $resP = $stmtP->get_result()->fetch_assoc();
    $totalPelanggan = (int)($resP['jml_pelanggan'] ?? 0);
} catch (Exception $e) {
    die("ERROR : " . $e->getMessage());
}

// Header HTTP untuk otomatis mengunduh file Excel (.xls)
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Penjualan_{$tglAwal}_sd_{$tglAkhir}.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<h3>Rekap Laporan Penjualan (<?= htmlspecialchars($tglAwal); ?> s/d <?= htmlspecialchars($tglAkhir); ?>)</h3>
<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Total Pendapatan</th>
            <th>Tanggal Transaksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($transaksi)): ?>
            <tr>
                <td colspan="3">Tidak ada data transaksi.</td>
            </tr>
        <?php else: ?>
            <?php $no = 1; foreach ($transaksi as $row): 
                $totalPendapatanKeseluruhan += (int)$row['total_pendapatan'];
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= (int)$row['total_pendapatan']; ?></td>
                    <td><?= htmlspecialchars((string)$row['tanggal']); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2"><strong>Jumlah Pelanggan Unik</strong></td>
                <td><strong><?= $totalPelanggan; ?> Orang</strong></td>
            </tr>
            <tr>
                <td colspan="2"><strong>Total Pendapatan Keseluruhan</strong></td>
                <td><strong><?= $totalPendapatanKeseluruhan; ?></strong></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
