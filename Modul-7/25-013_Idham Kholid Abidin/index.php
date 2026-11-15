<?php
include 'koneksi.php';

function tanggal_valid($tanggal)
{
    return preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal) === 1;
}

function rupiah($angka)
{
    return 'Rp ' . number_format((int) $angka, 0, ',', '.');
}

$rentang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT MIN(waktu_transaksi) AS mulai, MAX(waktu_transaksi) AS selesai FROM transaksi"));
$mulai = $_GET['mulai'] ?? $rentang['mulai'] ?? '';
$selesai = $_GET['selesai'] ?? $rentang['selesai'] ?? '';
$error = '';

if (!tanggal_valid($mulai) || !tanggal_valid($selesai)) {
    $error = 'Format tanggal tidak valid. Gunakan format YYYY-MM-DD.';
    $mulai = $rentang['mulai'] ?? '';
    $selesai = $rentang['selesai'] ?? '';
}

$rekap = [];
$total_pendapatan = 0;
$total_pelanggan = 0;

if ($error === '' && $mulai !== '' && $selesai !== '') {
    $mulai_aman = mysqli_real_escape_string($koneksi, $mulai);
    $selesai_aman = mysqli_real_escape_string($koneksi, $selesai);

    $query = mysqli_query($koneksi, "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian FROM transaksi WHERE waktu_transaksi BETWEEN '$mulai_aman' AND '$selesai_aman' GROUP BY DATE(waktu_transaksi) ORDER BY tgl ASC");

    while ($row = mysqli_fetch_assoc($query)) {
        $rekap[] = $row;
        $total_pendapatan += (int) $row['total_harian'];
    }

    $ringkasan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(DISTINCT pelanggan_id) AS jml_pelanggan FROM transaksi WHERE waktu_transaksi BETWEEN '$mulai_aman' AND '$selesai_aman'"));
    $total_pelanggan = (int) ($ringkasan['jml_pelanggan'] ?? 0);
}

$labels = array_column($rekap, 'tgl');
$data_total = array_column($rekap, 'total_harian');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #000;
        }
        .container {
            max-width: 950px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
        }
        h1, h2 {
            margin-top: 0;
        }
        form {
            margin-bottom: 15px;
        }
        label {
            margin-right: 10px;
            font-weight: bold;
        }
        input[type="date"] {
            padding: 5px;
            border: 1px solid #999;
        }
        button, .tombol {
            display: inline-block;
            padding: 6px 12px;
            border: 1px solid #000;
            background-color: #0000ff;
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 13px;
            text-decoration: none;
            cursor: pointer;
        }
        .tombol-putih {
            background-color: #fff;
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 7px;
            text-align: left;
        }
        th {
            background-color: #0000ff;
            color: #fff;
        }
        .grafik {
            width: 100%;
            max-width: 750px;
            height: 320px;
        }
        .ringkasan {
            margin-top: 15px;
        }
        .card {
            display: inline-block;
            min-width: 230px;
            margin-right: 10px;
            padding: 12px;
            border: 1px solid #000;
            background-color: #f9f9f9;
        }
        .card span {
            display: block;
            margin-top: 6px;
            font-size: 18px;
            font-weight: bold;
        }
        .pesan {
            padding: 10px;
            border: 1px solid #000;
            background-color: #ffffcc;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
                background-color: #fff;
            }
            .container {
                max-width: 100%;
                border: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Laporan Penjualan</h1>

    <div class="no-print">
        <form method="GET">
            <label>Dari <input type="date" name="mulai" value="<?= htmlspecialchars($mulai) ?>" required></label>
            <label>Sampai <input type="date" name="selesai" value="<?= htmlspecialchars($selesai) ?>" required></label>
            <button type="submit">Tampilkan</button>
            <button type="button" onclick="window.print()">Cetak</button>
            <a class="tombol" href="export_excel.php?mulai=<?= urlencode($mulai) ?>&selesai=<?= urlencode($selesai) ?>">Excel</a>
        </form>
    </div>

    <p>Periode: <b><?= htmlspecialchars(date('d-m-Y', strtotime($mulai))) ?></b> sampai <b><?= htmlspecialchars(date('d-m-Y', strtotime($selesai))) ?></b></p>

    <?php if ($error !== ''): ?>
        <p class="pesan"><?= htmlspecialchars($error) ?></p>
    <?php elseif (!$rekap): ?>
        <p class="pesan">Tidak ada transaksi pada rentang tanggal tersebut.</p>
    <?php else: ?>
        <h2>Grafik Penjualan</h2>
        <div class="grafik">
            <canvas id="grafikPenjualan"></canvas>
        </div>
        <script>
            new Chart(document.getElementById('grafikPenjualan'), {
                type: 'bar',
                data: {
                    labels: <?= json_encode($labels) ?>,
                    datasets: [{
                        label: 'Total Penjualan',
                        data: <?= json_encode($data_total) ?>,
                        backgroundColor: '#0000ff'
                    }]
                },
                options: {
                    animation: false,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <h2>Rekapitulasi Penjualan</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Total Pendapatan</th>
                <th>Tanggal Transaksi</th>
            </tr>
            <?php $no = 1; foreach ($rekap as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= rupiah($row['total_harian']) ?></td>
                    <td><?= htmlspecialchars(date('d-m-Y', strtotime($row['tgl']))) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="ringkasan">
            <div class="card">
                Jumlah Pelanggan
                <span><?= $total_pelanggan ?> Orang</span>
            </div>
            <div class="card">
                Jumlah Pendapatan
                <span><?= rupiah($total_pendapatan) ?></span>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
