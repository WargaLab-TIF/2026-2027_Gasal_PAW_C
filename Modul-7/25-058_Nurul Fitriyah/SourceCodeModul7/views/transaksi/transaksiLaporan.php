<?php
$tglAwal = $_REQUEST['tglAwal'] ?? '';
$tglAkhir = $_REQUEST['tglAkhir'] ?? '';

$transaksi = [];
$labels = [];
$dataTotal = [];
$totalPelanggan = 0;
$totalPendapatanKeseluruhan = 0;

if (!empty($tglAwal) && !empty($tglAkhir)) {
    // 1. Query agregasi harian untuk Grafik & Tabel Rekapitulasi
    $sql = "SELECT tanggal, SUM(total) AS total_pendapatan 
            FROM transaksi 
            WHERE tanggal BETWEEN ? AND ? 
            GROUP BY tanggal 
            ORDER BY tanggal ASC";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $tglAwal, $tglAkhir);
        $stmt->execute();
        $transaksi = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach ($transaksi as $row) {
            $labels[] = date('d M Y', strtotime($row['tanggal']));
            $dataTotal[] = (int)$row['total_pendapatan'];
            $totalPendapatanKeseluruhan += (int)$row['total_pendapatan'];
        }

        // 2. Query menghitung Jumlah Pelanggan Unik tanpa duplikasi
        $sqlPelanggan = "SELECT COUNT(DISTINCT pelanggan) AS jml_pelanggan 
                         FROM transaksi 
                         WHERE tanggal BETWEEN ? AND ?";
        $stmtP = $conn->prepare($sqlPelanggan);
        $stmtP->bind_param("ss", $tglAwal, $tglAkhir);
        $stmtP->execute();
        $resP = $stmtP->get_result()->fetch_assoc();
        $totalPelanggan = (int)($resP['jml_pelanggan'] ?? 0);
    } catch (Exception $e) {
        echo "ERROR : " . $e->getMessage();
    }
}
?>

<h2>Rekap Laporan Penjualan <?= (!empty($tglAwal) && !empty($tglAkhir)) ? "($tglAwal sampai $tglAkhir)" : ""; ?></h2>

<!-- Form Filter Rentang Tanggal -->
<div class="no-print">
    <form method="POST" action="?url=/transaksi/laporan" class="filter-form">
        <label>Dari :
            <input type="date" name="tglAwal" value="<?= htmlspecialchars($tglAwal); ?>" required>
        </label>
        <label>Sampai :
            <input type="date" name="tglAkhir" value="<?= htmlspecialchars($tglAkhir); ?>" required>
        </label>
        <button type="submit">Tampilkan</button>
        <a href="?url=/transaksi" style="background-color: #64748b;">Kembali</a>
    </form>
</div>

<?php if (!empty($tglAwal) && !empty($tglAkhir)): ?>
    <?php if (empty($transaksi)): ?>
        <p style="margin-top: 1rem; color: #64748b;">Tidak ada data transaksi pada rentang tanggal tersebut.</p>
    <?php else: ?>
        <!-- Tombol Cetak & Ekspor Excel -->
        <div class="action-bar no-print">
            <button type="button" class="btn-print" onclick="window.print()">Cetak</button>
            <a href="views/transaksi/transaksiLaporanExcel.php?tglAwal=<?= urlencode($tglAwal); ?>&tglAkhir=<?= urlencode($tglAkhir); ?>" class="btn-excel">Excel</a>
        </div>

        <!-- Visualisasi Grafik Batang (Bar Chart) -->
        <div style="width: 100%; max-width: 850px; height: 350px; margin: 20px 0;">
            <canvas id="myChart"></canvas>
        </div>

        <script>
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($labels); ?>,
                    datasets: [{
                        label: 'Total Pendapatan Harian (Rp)',
                        data: <?= json_encode($dataTotal); ?>,
                        backgroundColor: 'rgba(2, 132, 199, 0.7)',
                        borderColor: 'rgba(2, 132, 199, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <!-- Tabel Rekapitulasi Data Penjualan Harian -->
        <table>
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Total Pendapatan</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($transaksi as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>Rp <?= number_format((float)$row['total_pendapatan'], 0, ',', '.'); ?></td>
                        <td><?= date('d M Y', strtotime($row['tanggal'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Card Ringkasan Informasi Total Kumulatif -->
        <div class="summary-container">
            <div class="summary-card">
                <span>Jumlah Pelanggan Unik</span>
                <strong><?= number_format($totalPelanggan, 0, ',', '.'); ?> Orang</strong>
            </div>
            <div class="summary-card">
                <span>Total Pendapatan Keseluruhan</span>
                <strong>Rp <?= number_format($totalPendapatanKeseluruhan, 0, ',', '.'); ?></strong>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
