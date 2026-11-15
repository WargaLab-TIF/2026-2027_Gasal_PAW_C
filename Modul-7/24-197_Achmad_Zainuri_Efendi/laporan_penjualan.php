<?php
include 'koneksi.php';

$q_range = mysqli_query($koneksi, "SELECT MIN(waktu_transaksi) AS min_tgl, MAX(waktu_transaksi) AS max_tgl FROM transaksi");
$range   = mysqli_fetch_assoc($q_range);

$default_mulai   = $range['min_tgl'] ?? date('Y-m-01');
$default_selesai = $range['max_tgl'] ?? date('Y-m-d');

$tanggal_mulai   = isset($_GET['tanggal_mulai']) && $_GET['tanggal_mulai'] !== '' ? $_GET['tanggal_mulai'] : $default_mulai;
$tanggal_selesai = isset($_GET['tanggal_selesai']) && $_GET['tanggal_selesai'] !== '' ? $_GET['tanggal_selesai'] : $default_selesai;

$tgl_mulai_safe   = mysqli_real_escape_string($koneksi, $tanggal_mulai);
$tgl_selesai_safe = mysqli_real_escape_string($koneksi, $tanggal_selesai);

$sql_harian = "SELECT waktu_transaksi, SUM(total) AS total_harian 
               FROM transaksi 
               WHERE waktu_transaksi BETWEEN '$tgl_mulai_safe' AND '$tgl_selesai_safe'
               GROUP BY waktu_transaksi 
               ORDER BY waktu_transaksi ASC";
$res_harian = mysqli_query($koneksi, $sql_harian);

$data_tabel      = [];
$labels_tanggal  = [];
$data_pendapatan = [];

while ($row = mysqli_fetch_assoc($res_harian)) {
    $data_tabel[]      = $row;
    $labels_tanggal[]  = date('d M Y', strtotime($row['waktu_transaksi']));
    $data_pendapatan[] = (int) $row['total_harian'];
}

$sql_ringkasan = "SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan, 
                         COALESCE(SUM(total), 0) AS total_keseluruhan 
                  FROM transaksi 
                  WHERE waktu_transaksi BETWEEN '$tgl_mulai_safe' AND '$tgl_selesai_safe'";
$res_ringkasan = mysqli_query($koneksi, $sql_ringkasan);
$ringkasan     = mysqli_fetch_assoc($res_ringkasan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekapitulasi Penjualan</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">
    <div class="header-laporan">
        <h2>Laporan Rekapitulasi Penjualan</h2>
        <p>Periode: <strong><?= date('d/m/Y', strtotime($tanggal_mulai)) ?></strong> s/d <strong><?= date('d/m/Y', strtotime($tanggal_selesai)) ?></strong></p>
    </div>

    <!-- Bagian Filter & Tombol Aksi (Disembunyikan saat Print) -->
    <div class="toolbar no-print">
        <form method="GET" action="" class="filter-form">
            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="<?= htmlspecialchars($tanggal_mulai) ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="<?= htmlspecialchars($tanggal_selesai) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </form>

        <div class="action-buttons">
            <button type="button" onclick="window.print()" class="btn btn-print">Cetak</button>
            <a href="export_excel.php?tanggal_mulai=<?= urlencode($tanggal_mulai) ?>&tanggal_selesai=<?= urlencode($tanggal_selesai) ?>" class="btn btn-excel">Ekspor Excel</a>
        </div>
    </div>

    <div class="chart-section">
        <h3>Grafik Tren Pendapatan Harian</h3>
        <div class="chart-wrapper">
            <canvas id="grafikPenjualan"></canvas>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center col-no">No</th>
                <th class="text-right">Total Pendapatan</th>
                <th class="text-center">Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($data_tabel) > 0): ?>
                <?php $no = 1; foreach ($data_tabel as $row): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-right">Rp <?= number_format($row['total_harian'], 0, ',', '.') ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($row['waktu_transaksi'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data transaksi pada rentang tanggal tersebut.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="summary-cards">
        <div class="card">
            <div class="card-title">Jumlah Pelanggan Unik</div>
            <div class="card-value"><?= number_format($ringkasan['jumlah_pelanggan'], 0, ',', '.') ?> Pelanggan</div>
        </div>
        <div class="card card-revenue">
            <div class="card-title">Total Pendapatan Keseluruhan</div>
            <div class="card-value">Rp <?= number_format($ringkasan['total_keseluruhan'], 0, ',', '.') ?></div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('grafikPenjualan').getContext('2d');
    const labelsTanggal = <?= json_encode($labels_tanggal) ?>;
    const dataPendapatan = <?= json_encode($data_pendapatan) ?>;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelsTanggal,
            datasets: [{
                label: 'Total Pendapatan (Rp)',
                data: dataPendapatan,
                backgroundColor: 'rgba(37, 99, 235, 0.75)',
                borderColor: 'rgba(37, 99, 235, 1)',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal Transaksi'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Pendapatan (Rp)'
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Pendapatan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>