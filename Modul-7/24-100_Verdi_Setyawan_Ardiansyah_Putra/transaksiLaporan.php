<?php
require_once __DIR__ . '/conn.php';

$tanggalMulai = $_GET['tanggal_mulai'] ?? '';
$tanggalSelesai = $_GET['tanggal_selesai'] ?? '';

$pesan = '';
$filter = false;
$transaksi = [];
$totalPelanggan = 0;
$totalPendapatan = 0;

function tanggalValidLaporan($tanggal)
{
    $hasil = DateTime::createFromFormat('!Y-m-d', $tanggal);
    return $hasil && $hasil->format('Y-m-d') === $tanggal;
}

if ($tanggalMulai != '' && $tanggalSelesai != '') {
    if (!tanggalValidLaporan($tanggalMulai) || !tanggalValidLaporan($tanggalSelesai)) {
        $pesan = 'Format tanggal tidak valid.';
    } elseif ($tanggalMulai > $tanggalSelesai) {
        $pesan = 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai.';
    } else {
        $filter = true;
    }
} elseif ($tanggalMulai != '' || $tanggalSelesai != '') {
    $pesan = 'Tanggal mulai dan tanggal selesai harus diisi.';
}

if ($pesan == '') {
    $sql = "SELECT tanggal, SUM(total) AS pendapatan
    FROM transaksi";

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
        die('Query laporan gagal: ' . $conn->error);
    }

    $transaksi = $hasil->fetch_all(MYSQLI_ASSOC);

    $sqlRingkasan = "SELECT COUNT(DISTINCT pelanggan) AS jumlah_pelanggan,
    COALESCE(SUM(total), 0) AS total_pendapatan
    FROM transaksi";

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
        die('Query ringkasan gagal: ' . $conn->error);
    }

    $ringkasan = $hasilRingkasan->fetch_assoc();
    $totalPelanggan = $ringkasan['jumlah_pelanggan'] ?? 0;
    $totalPendapatan = $ringkasan['total_pendapatan'] ?? 0;
}

$labelGrafik = [];
$dataGrafik = [];

foreach ($transaksi as $row) {
    $labelGrafik[] = date('d-m-Y', strtotime($row['tanggal']));
    $dataGrafik[] = (float) $row['pendapatan'];
}

$linkExcel = 'transaksiLaporanExcel.php';
if ($filter) {
    $linkExcel .= '?' . http_build_query([
        'tanggal_mulai' => $tanggalMulai,
        'tanggal_selesai' => $tanggalSelesai
    ]);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<main>
    <div class="judul-laporan">
        <div>
            <h2>Laporan Penjualan</h2>
            <p>Rekap pendapatan penjualan berdasarkan tanggal transaksi.</p>
        </div>

        <?php if ($pesan == ''): ?>
            <div class="tombol-laporan no-print">
                <button type="button" onclick="window.print()">Cetak</button>
                <a href="<?= htmlspecialchars($linkExcel); ?>">Excel</a>
            </div>
        <?php endif; ?>
    </div>

    <form method="GET" action="transaksiLaporan.php" class="form-filter no-print">
        <div>
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                   value="<?= htmlspecialchars($tanggalMulai); ?>">
        </div>

        <div>
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                   value="<?= htmlspecialchars($tanggalSelesai); ?>">
        </div>

        <div class="filter-tombol">
            <button type="submit">Tampilkan</button>
            <a href="transaksiLaporan.php" class="tombol-reset">Reset</a>
        </div>
    </form>

    <?php if ($pesan != ''): ?>
        <p class="pesan-error no-print"><?= htmlspecialchars($pesan); ?></p>
    <?php elseif ($filter): ?>
        <p class="periode-laporan">
            Periode: <?= date('d-m-Y', strtotime($tanggalMulai)); ?> sampai
            <?= date('d-m-Y', strtotime($tanggalSelesai)); ?>
        </p>
    <?php else: ?>
        <p class="periode-laporan">Periode: Semua tanggal</p>
    <?php endif; ?>

    <h3 class="subjudul-laporan">Grafik Pendapatan Harian</h3>
    <div class="grafik-laporan">
        <?php if (empty($transaksi)): ?>
            <p>Belum ada data penjualan pada periode ini.</p>
        <?php else: ?>
            <canvas id="grafikPenjualan"></canvas>
        <?php endif; ?>
    </div>

    <h3 class="subjudul-laporan">Rekapitulasi Penjualan Harian</h3>
    <div class="tabel-laporan">
        <table>
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
                        <td colspan="3">Belum ada data transaksi.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; ?>
                    <?php foreach ($transaksi as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>Rp <?= number_format((float) $row['pendapatan'], 0, ',', '.'); ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <h3 class="subjudul-laporan">Ringkasan Penjualan</h3>
    <div class="ringkasan-laporan">
        <div class="kotak-ringkasan">
            <p>Jumlah Pelanggan Unik</p>
            <h3><?= number_format((int) $totalPelanggan, 0, ',', '.'); ?></h3>
        </div>
        <div class="kotak-ringkasan">
            <p>Total Pendapatan Keseluruhan</p>
            <h3>Rp <?= number_format((float) $totalPendapatan, 0, ',', '.'); ?></h3>
        </div>
    </div>
</main>

<?php if (!empty($transaksi)): ?>
<script>
    const labelGrafik = <?= json_encode($labelGrafik, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
    const dataGrafik = <?= json_encode($dataGrafik); ?>;

    new Chart(document.getElementById('grafikPenjualan'), {
        type: 'bar',
        data: {
            labels: labelGrafik,
            datasets: [{
                label: 'Total Pendapatan (Rp)',
                data: dataGrafik,
                backgroundColor: '#38a3d1',
                borderColor: '#1479a8',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Pendapatan (Rp)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal Transaksi'
                    }
                }
            }
        }
    });
</script>
<?php endif; ?>
</body>
</html>