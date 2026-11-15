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

$labels = array();
$data_total = array();
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
    $labels[] = $row['tgl'];
    $data_total[] = (int) $row['total_harian'];
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
    <h2>Laporan Penjualan</h2>

    <div class="no-print">
        <form method="GET">
            <label>Dari
                <input type="date" name="tanggal_mulai" value="<?= htmlspecialchars($mulai) ?>" required>
            </label>
            <label>Sampai
                <input type="date" name="tanggal_selesai" value="<?= htmlspecialchars($selesai) ?>" required>
            </label>
            <button type="submit">Tampilkan</button>
        </form>

        <div class="aksi">
            <button type="button" onclick="window.print()">Cetak</button>
            <a class="tombol-excel" href="export_excel.php?tanggal_mulai=<?= $mulai ?>&tanggal_selesai=<?= $selesai ?>">Excel</a>
        </div>
    </div>

    <p class="periode">Periode: <?= $mulai ?> s.d. <?= $selesai ?></p>

    <?php if (count($rekap) == 0): ?>
        <p class="kosong">Tidak ada transaksi pada rentang tanggal tersebut.</p>
    <?php else: ?>
        <div class="grafik">
            <canvas id="grafikPenjualan" role="img" aria-label="Grafik total pendapatan per tanggal"></canvas>
        </div>

        <h2>Rekapitulasi Penjualan Harian</h2>
        <table>
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Total Pendapatan</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>

        <div class="ringkasan">
            <div class="card">
                <span class="card-label">Jumlah Pelanggan Unik</span>
                <span class="card-nilai"><?= number_format($total_pelanggan, 0, ',', '.') ?> Orang</span>
            </div>
            <div class="card">
                <span class="card-label">Total Pendapatan Keseluruhan</span>
                <span class="card-nilai">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></span>
            </div>
        </div>

        <script>
            const ctx = document.getElementById('grafikPenjualan').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($labels) ?>,
                    datasets: [{
                        label: 'Total Penjualan',
                        data: <?= json_encode($data_total) ?>
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: false,
                    scales: {
                        x: {
                            title: { display: true, text: 'Tanggal Transaksi' },
                            ticks: { autoSkip: true, maxTicksLimit: 12 }
                        },
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'Total Pendapatan' }
                        }
                    }
                }
            });
        </script>
    <?php endif; ?>
</main>
</body>
</html>

