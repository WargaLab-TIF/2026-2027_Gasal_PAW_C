<?php
require 'koneksi.php';

$mulai   = $_GET['mulai']   ?? '';
$selesai = $_GET['selesai'] ?? '';

$transaksi    = [];
$rekap        = [];
$ringkasan    = ['jml_pelanggan' => 0, 'total_semua' => 0];
$pesan        = '';
$sudah_filter = ($mulai !== '' && $selesai !== '');

if ($sudah_filter) {
    $format_ok = preg_match('/^\d{4}-\d{2}-\d{2}$/', $mulai)
              && preg_match('/^\d{4}-\d{2}-\d{2}$/', $selesai);

    if (!$format_ok) {
        $pesan = "Format tanggal tidak valid.";
    } elseif ($mulai > $selesai) {
        $pesan = "Tanggal mulai tidak boleh lebih besar dari tanggal selesai.";
    } else {
        // Soal 1: transaksi apa adanya (satu baris per transaksi) pada rentang tanggal
        $stmt = mysqli_prepare($koneksi,
            "SELECT t.id, t.waktu_transaksi, p.nama AS nama_pelanggan, t.total
               FROM transaksi t
               LEFT JOIN pelanggan p ON p.id = t.pelanggan_id
              WHERE t.waktu_transaksi BETWEEN ? AND ?
              ORDER BY t.waktu_transaksi ASC, t.id ASC");
        mysqli_stmt_bind_param($stmt, "ss", $mulai, $selesai);
        mysqli_stmt_execute($stmt);
        $hasil = mysqli_stmt_get_result($stmt);
        while ($t = mysqli_fetch_assoc($hasil)) {
            $transaksi[] = $t;
        }

        // Soal 2 dan 3: total pendapatan per hari (agregasi SUM + GROUP BY)
        $stmt2 = mysqli_prepare($koneksi,
            "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian
               FROM transaksi
              WHERE waktu_transaksi BETWEEN ? AND ?
              GROUP BY DATE(waktu_transaksi)
              ORDER BY tgl ASC");
        mysqli_stmt_bind_param($stmt2, "ss", $mulai, $selesai);
        mysqli_stmt_execute($stmt2);
        $hasil2 = mysqli_stmt_get_result($stmt2);
        while ($r = mysqli_fetch_assoc($hasil2)) {
            $rekap[] = $r;
        }

        // Soal 3: ringkasan kumulatif (pelanggan unik dan total pendapatan) pada periode yang sama
        $stmt3 = mysqli_prepare($koneksi,
            "SELECT COUNT(DISTINCT pelanggan_id) AS jml_pelanggan,
                    COALESCE(SUM(total), 0) AS total_semua
               FROM transaksi
              WHERE waktu_transaksi BETWEEN ? AND ?");
        mysqli_stmt_bind_param($stmt3, "ss", $mulai, $selesai);
        mysqli_stmt_execute($stmt3);
        $ringkasan = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt3));
    }
}
// Data untuk grafik: sumbu X = tanggal, sumbu Y = total pendapatan harian
$labels     = [];
$data_total = [];
foreach ($rekap as $r) {
    $labels[]     = $r['tgl'];
    $data_total[] = (int)$r['total_harian'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Penjualan</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.6.1/dist/chart.umd.min.js"></script>
</head>
<body>

  <div class="no-print">
    <h1>Filter Laporan Penjualan</h1>
    <form method="get" class="box">
      <p><label>Tanggal mulai</label>
         <input type="date" name="mulai" value="<?= h($mulai) ?>" required></p>
      <p><label>Tanggal selesai</label>
         <input type="date" name="selesai" value="<?= h($selesai) ?>" required></p>
      <button type="submit">Tampilkan</button>
    </form>
  </div>

  <?php if ($pesan): ?>
    <div class="pesan gagal"><?= h($pesan) ?></div>
  <?php endif; ?>

  <?php if ($sudah_filter && !$pesan): ?>
    <h1>Rekap Laporan Penjualan
      <small><?= h($mulai) ?> sampai <?= h($selesai) ?></small></h1>

    <div class="no-print">
      <button type="button" onclick="window.print()">Cetak</button>
      <a class="btn" href="export_excel.php?mulai=<?= urlencode($mulai) ?>&amp;selesai=<?= urlencode($selesai) ?>">Excel</a>
    </div>

    <h2>Daftar Transaksi pada Rentang Tanggal</h2>
    <table>
      <tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th class="angka">Total</th></tr>
      <?php foreach ($transaksi as $t): ?>
        <tr>
          <td><?= (int)$t['id'] ?></td>
          <td><?= h($t['waktu_transaksi']) ?></td>
          <td><?= h($t['nama_pelanggan']) ?></td>
          <td class="angka"><?= rupiah($t['total']) ?></td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($transaksi)): ?>
        <tr><td colspan="4">Tidak ada transaksi pada rentang tanggal ini.</td></tr>
      <?php endif; ?>
    </table>

    <?php if (!empty($rekap)): ?>
      <h2>Grafik Penjualan</h2>
      <div style="max-width: 800px;"><canvas id="grafik"></canvas></div>
      <script>
        new Chart(document.getElementById('grafik'), {
          type: 'bar',
          data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
              label: 'Total Pendapatan (Rp)',
              data: <?= json_encode($data_total) ?>,
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              x: { title: { display: true, text: 'Tanggal Transaksi' } },
              y: {
                beginAtZero: true,
                title: { display: true, text: 'Total Pendapatan (Rp)' },
                ticks: { callback: function (v) { return v.toLocaleString('id-ID'); } }
              }
            }
          }
        });
      </script>

      <h2>Rekapitulasi</h2>
      <table>
        <tr><th>No</th><th class="angka">Total Pendapatan</th><th>Tanggal Transaksi</th></tr>
        <?php $no = 1; foreach ($rekap as $row): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td class="angka"><?= rupiah($row['total_harian']) ?></td>
            <td><?= h(date('d M Y', strtotime($row['tgl']))) ?></td>
          </tr>
        <?php endforeach; ?>
      </table>

      <table style="width: auto; min-width: 420px;">
        <tr><th>Jumlah Pelanggan</th><th>Total Pendapatan</th></tr>
        <tr>
          <td class="angka"><?= (int)$ringkasan['jml_pelanggan'] ?> Orang</td>
          <td class="angka"><?= rupiah($ringkasan['total_semua']) ?></td>
        </tr>
      </table>
    <?php endif; ?>
  <?php endif; ?>

</body>
</html>