<?php
include "koneksi.php";
function tanggal_valid($t) {
    $d = DateTime::createFromFormat('Y-m-d', $t);
    return $d && $d->format('Y-m-d') === $t;
}

$tanggal_mulai   = $_GET['tanggal_mulai']   ?? '';
$tanggal_selesai = $_GET['tanggal_selesai'] ?? '';
$pesan_error  = '';
$filter_aktif = false;

if ($tanggal_mulai !== '' || $tanggal_selesai !== '') {
    if (!tanggal_valid($tanggal_mulai) || !tanggal_valid($tanggal_selesai)) {
        $pesan_error = "Tanggal mulai dan tanggal selesai harus diisi dengan benar.";
    } elseif ($tanggal_mulai > $tanggal_selesai) {
        $pesan_error = "Tanggal mulai tidak boleh lebih besar dari tanggal selesai.";
    } else {
        $filter_aktif = true;
    }
}

$data = [];
$rekap = [];
$jumlah_pelanggan  = 0;
$total_keseluruhan = 0;
if ($pesan_error === '') {
    $where = $filter_aktif ? "WHERE waktu_transaksi BETWEEN ? AND ?" : "";
    $stmt = mysqli_prepare($koneksi, "SELECT id, waktu_transaksi, keterangan, total, pelanggan_id
                                      FROM transaksi $where
                                      ORDER BY waktu_transaksi ASC, id ASC");
    if ($filter_aktif) mysqli_stmt_bind_param($stmt, "ss", $tanggal_mulai, $tanggal_selesai);
    mysqli_stmt_execute($stmt);
    $hasil = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($hasil)) $data[] = $row;

    $stmt = mysqli_prepare($koneksi, "SELECT waktu_transaksi AS tanggal, SUM(total) AS total_harian
                                      FROM transaksi $where
                                      GROUP BY waktu_transaksi
                                      ORDER BY waktu_transaksi ASC");
    if ($filter_aktif) mysqli_stmt_bind_param($stmt, "ss", $tanggal_mulai, $tanggal_selesai);
    mysqli_stmt_execute($stmt);
    $hasil = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($hasil)) $rekap[] = $row;

    $stmt = mysqli_prepare($koneksi, "SELECT COUNT(DISTINCT pelanggan_id) AS jml_pelanggan,
                                             COALESCE(SUM(total), 0) AS total_semua
                                      FROM transaksi $where");
    if ($filter_aktif) mysqli_stmt_bind_param($stmt, "ss", $tanggal_mulai, $tanggal_selesai);
    mysqli_stmt_execute($stmt);
    $ringkas = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    $jumlah_pelanggan  = (int) $ringkas['jml_pelanggan'];
    $total_keseluruhan = (int) $ringkas['total_semua'];
}

$label_chart = array_column($rekap, 'tanggal');
$data_chart  = array_map('intval', array_column($rekap, 'total_harian'));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        @media print {
            .no-print { display: none !important; }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
</head>
<body>


<h2>Laporan Penjualan</h2>

<a href="index.php" class="no-print">Kembali ke Data Transaksi</a>
<form method="get" action="laporan.php" class="no-print">
    <label>Tanggal Mulai:</label>
    <input type="date" name="tanggal_mulai" value="<?= htmlspecialchars($tanggal_mulai); ?>" required>
    <label>Tanggal Selesai:</label>
    <input type="date" name="tanggal_selesai" value="<?= htmlspecialchars($tanggal_selesai); ?>" required>
    <button type="submit">Tampilkan</button>
    <a href="laporan.php">Reset</a>
</form>

<?php if ($pesan_error !== '') { ?>
    <p><?= htmlspecialchars($pesan_error); ?></p>
<?php } else { ?>

<p>Periode:
    <?= $filter_aktif
        ? date('d-m-Y', strtotime($tanggal_mulai)) . " s/d " . date('d-m-Y', strtotime($tanggal_selesai))
        : "Semua tanggal"; ?>
</p>

<?php $query_export = http_build_query(['tanggal_mulai' => $tanggal_mulai, 'tanggal_selesai' => $tanggal_selesai]); ?>
<div class="no-print">
    <button type="button" onclick="window.print()">Cetak</button>
    <a href="export_excel.php?<?= $query_export; ?>"><button type="button">Excel</button></a>
</div>

<h3>Grafik Pendapatan Harian</h3>
<?php if (count($rekap) > 0) { ?>
<canvas id="grafikPenjualan" width="800" height="400"></canvas>
<?php } else { ?>
<p>Tidak ada data untuk ditampilkan pada grafik.</p>
<?php } ?>

<h3>Rekapitulasi Penjualan Harian</h3>
<table border="1">
    <tr>
        <th>No</th>
        <th>Total Pendapatan</th>
        <th>Tanggal Transaksi</th>
    </tr>
    <?php if (count($rekap) > 0) {
        $no = 1;
        foreach ($rekap as $r) { ?>
    <tr>
        <td><?= $no++; ?></td>
        <td>Rp <?= number_format($r['total_harian'], 0, ',', '.'); ?></td>
        <td><?= date('d-m-Y', strtotime($r['tanggal'])); ?></td>
    </tr>
    <?php } } else { ?>
    <tr><td colspan="3">Tidak ada transaksi pada periode ini.</td></tr>
    <?php } ?>
</table>

<h3>Ringkasan</h3>
<table border="1">
    <tr>
        <th>Jumlah Pelanggan Unik</th>
        <td><?= $jumlah_pelanggan; ?></td>
    </tr>
    <tr>
        <th>Total Pendapatan Keseluruhan</th>
        <td>Rp <?= number_format($total_keseluruhan, 0, ',', '.'); ?></td>
    </tr>
</table>

<?php if (count($rekap) > 0) { ?>
<script>
const labels = <?= json_encode($label_chart); ?>;
const dataPendapatan = <?= json_encode($data_chart); ?>;
const formatRp = v => 'Rp ' + Number(v).toLocaleString('id-ID');

new Chart(document.getElementById('grafikPenjualan'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Total Pendapatan (Rp)',
            data: dataPendapatan
        }]
    },
    options: {
        responsive: false,
        animation: false,
        plugins: {
            tooltip: { callbacks: { label: c => formatRp(c.parsed.y) } }
        },
        scales: {
            x: { title: { display: true, text: 'Tanggal Transaksi' } },
            y: {
                beginAtZero: true,
                title: { display: true, text: 'Total Pendapatan (Rp)' },
                ticks: { callback: v => formatRp(v) }
            }
        }
    }
});
</script>
<?php } ?>

<?php } ?>
</body>
</html>
