
<?php
// Ambil input tanggal dari form, default ke awal & akhir bulan ini jika kosong
$tglAwal = $_POST['tglAwal'] ?? date('Y-m-01');
$tglAkhir = $_POST['tglAkhir'] ?? date('Y-m-d');

$transaksi = [];
$jumlahPelanggan = 0;
$totalKeseluruhan = 0;

if (!empty($tglAwal) && !empty($tglAkhir)) {

    // 1. Ambil data dari database berdasarkan rentang tanggal
    $stmt = $conn->prepare("SELECT tanggal, COUNT(id) AS total_transaksi, SUM(total) AS total_pendapatan
                            FROM transaksi
                            WHERE tanggal BETWEEN ? AND ?
                            GROUP BY tanggal");

    $stmt->bind_param("ss", $tglAwal, $tglAkhir);
    $stmt->execute();
    $result = $stmt->get_result();

    // 2. Mengambil jumlah pelanggan unik dan total pendapatan
    $stmt2 = $conn->prepare("
        SELECT
            COUNT(DISTINCT pelanggan) AS jumlah_pelanggan,
            COALESCE(SUM(total), 0) AS total_keseluruhan
        FROM transaksi
        WHERE tanggal BETWEEN ? AND ?
    ");

    $stmt2->bind_param("ss", $tglAwal, $tglAkhir);
    $stmt2->execute();

    $result2 = $stmt2->get_result();
    $ringkasan = $result2->fetch_assoc();

    $jumlahPelanggan = $ringkasan['jumlah_pelanggan'] ?? 0;
    $totalKeseluruhan = $ringkasan['total_keseluruhan'] ?? 0;

    $raw_data = [];

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $raw_data[$row['tanggal']] = $row;
        }
    }

    // 3. Generate semua tanggal secara berurutan
    try {
        $period = new DatePeriod(
            new DateTime($tglAwal),
            new DateInterval('P1D'),
            (new DateTime($tglAkhir))->modify('+1 day')
        );

        foreach ($period as $date) {
            $tglStr = $date->format('Y-m-d');

            if (isset($raw_data[$tglStr])) {
                $transaksi[] = $raw_data[$tglStr];
            } else {
                $transaksi[] = [
                    'tanggal' => $tglStr,
                    'total_transaksi' => 0,
                    'total_pendapatan' => 0
                ];
            }
        }

    } catch (Exception $e) {
        $errorMsg = $e->getMessage();
    }
}

// 4. Menyiapkan data untuk Chart.js
$arrTanggal = [];
$arrPendapatan = [];

foreach ($transaksi as $row) {
    $arrTanggal[] = $row['tanggal'];
    $arrPendapatan[] = (float) $row['total_pendapatan'];
}
?>

<!-- Memuat Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- CSS untuk Cetak -->
<style>
@media print {
    .no-print {
        display: none !important;
    }
}
</style>

<h2>Laporan Transaksi & Grafik Pendapatan</h2>

<div class="no-print" style="margin-bottom: 1rem;">
    <a href="?url=/transaksi">Kembali ke Daftar Transaksi</a>
</div>

<!-- Form Filter Tanggal -->
<form method="POST" action="" class="no-print" style="margin-bottom: 1.5rem; background: #f8fafc; padding: 1rem; border-radius: 6px;">

    <div style="display: inline-block; margin-right: 1rem;">
        <label for="tglAwal" style="display: block; font-size: 0.85rem; margin-bottom: 0.3rem;">Tanggal Awal:</label>
        <input type="date" id="tglAwal" name="tglAwal" value="<?= htmlspecialchars($tglAwal); ?>" required style="padding: 0.4rem;">
    </div>

    <div style="display: inline-block; margin-right: 1rem;">
        <label for="tglAkhir" style="display: block; font-size: 0.85rem; margin-bottom: 0.3rem;">Tanggal Akhir:</label>
        <input type="date" id="tglAkhir" name="tglAkhir" value="<?= htmlspecialchars($tglAkhir); ?>" required style="padding: 0.4rem;">
    </div>

    <div style="display: inline-block; vertical-align: bottom;">
        <button type="submit" style="padding: 0.45rem 1rem; cursor: pointer;">Tampilkan</button>
        <a href="?url=/transaksi/laporan" style="margin-left: 0.5rem; text-decoration: none;">Reset</a>
    </div>

</form>

<?php if (isset($errorMsg)): ?>

    <p style="color: red;">ERROR: <?= htmlspecialchars($errorMsg); ?></p>

<?php endif; ?>

<!-- Grafik Pendapatan Chart.js -->
<div style="background: #fff; padding: 1rem; border-radius: 6px; margin-bottom: 2rem;">
    <canvas id="grafikPendapatan" style="max-height: 350px; width: 100%;"></canvas>
</div>

<?php if (empty($transaksi)): ?>

    <p style="margin-top: 1rem; color: #64748b;">
        Tidak ada data transaksi pada rentang tanggal tersebut.
    </p>

<?php else: ?>

    <!-- Tabel Rekapitulasi Penjualan Harian -->
    <h3>Rekapitulasi Penjualan Harian</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Total Pendapatan</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; foreach ($transaksi as $row): ?>

                <tr>
                    <td><?= $no++; ?></td>

                    <td>
                        Rp <?= number_format((float)$row['total_pendapatan'], 0, ',', '.'); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars((string)$row['tanggal']); ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

    <!-- Tombol Download Excel -->
    <div class="no-print" style="margin-bottom: 1rem;">
        <a href="?url=/transaksi/laporanExcel&tglAwal=<?= urlencode($tglAwal); ?>&tglAkhir=<?= urlencode($tglAkhir); ?>"
           target="_blank"
           style="padding: 0.45rem 1rem; background: #16a34a; color: #fff; text-decoration: none; border-radius: 4px;">
            Download Excel
        </a>
    </div>

<?php endif; ?>

<!-- Ringkasan Keseluruhan -->
<h3>Ringkasan Keseluruhan</h3>

<div style="display: flex; gap: 15px; margin-bottom: 20px;">

    <div style="border: 1px solid #ddd; padding: 15px; width: 250px; border-radius: 5px;">
        <p>Jumlah Pelanggan Unik</p>
        <h2><?= number_format((int)$jumlahPelanggan, 0, ',', '.'); ?></h2>
    </div>

    <div style="border: 1px solid #ddd; padding: 15px; width: 250px; border-radius: 5px;">
        <p>Total Pendapatan Keseluruhan</p>
        <h2>
            Rp <?= number_format((float)$totalKeseluruhan, 0, ',', '.'); ?>
        </h2>
    </div>

</div>

<!-- Tombol Cetak -->
<div class="no-print" style="margin-bottom: 1rem;">
    <button type="button" onclick="window.print()">
        Cetak
    </button>
</div>

<!-- Script untuk Merender Chart.js -->
<script>
const ctx = document.getElementById('grafikPendapatan').getContext('2d');

const grafikPendapatan = new Chart(ctx, {
    type: 'bar',

    data: {
        labels: <?= json_encode($arrTanggal); ?>,

        datasets: [{
            label: 'Total Pendapatan Harian (Rp)',
            data: <?= json_encode($arrPendapatan); ?>,
            backgroundColor: 'rgba(37, 99, 235, 0.6)',
            borderColor: 'rgba(37, 99, 235, 1)',
            borderWidth: 1
        }]
    },

    options: {
        responsive: true,

        scales: {
            y: {
                beginAtZero: true,

                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});
</script>
