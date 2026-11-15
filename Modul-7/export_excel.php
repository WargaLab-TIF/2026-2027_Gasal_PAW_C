<?php

declare(strict_types=1);

require __DIR__ . '/laporan.php';

try {
    [$mulai, $selesai] = filterTanggal($_GET);
    $conn = koneksi();
    $laporan = ambilLaporan($conn, $mulai, $selesai);
    $conn->close();
} catch (InvalidArgumentException $exception) {
    http_response_code(422);
    header('Content-Type: text/plain; charset=UTF-8');
    exit($exception->getMessage());
} catch (mysqli_sql_exception $exception) {
    http_response_code(503);
    header('Content-Type: text/plain; charset=UTF-8');
    exit('Ekspor gagal. Pastikan MySQL aktif dan database penjualan beserta tabel transaksi tersedia.');
}

header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="laporan_penjualan_' . $mulai . '_' . $selesai . '.xls"');
header('Cache-Control: no-store');
header('X-Content-Type-Options: nosniff');
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Rekap Laporan Penjualan</title></head>
<body>
<h1>Rekap Laporan Penjualan <?= e($mulai) ?> sampai <?= e($selesai) ?></h1>
<table border="1">
    <thead><tr><th>No</th><th>Total Pendapatan</th><th>Tanggal Transaksi</th></tr></thead>
    <tbody>
    <?php foreach ($laporan['rekap'] as $index => $row): ?>
        <tr><td><?= $index + 1 ?></td><td><?= e($row['total_harian']) ?></td><td><?= e($row['tanggal']) ?></td></tr>
    <?php endforeach; ?>
    <?php if ($laporan['rekap'] === []): ?>
        <tr><td colspan="3">Tidak ada transaksi pada periode ini.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
<table border="1">
    <tr><th>Jumlah Pelanggan Unik</th><th>Total Pendapatan Keseluruhan</th></tr>
    <tr><td><?= (int) $laporan['ringkasan']['jumlah_pelanggan'] ?></td><td><?= e($laporan['ringkasan']['total_pendapatan']) ?></td></tr>
</table>
<p>Nominal pendapatan dalam rupiah.</p>
</body>
</html>
