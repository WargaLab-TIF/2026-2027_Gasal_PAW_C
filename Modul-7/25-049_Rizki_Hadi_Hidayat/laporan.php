<?php
require_once 'koneksi.php';

$labels = [];
$data_total = [];
$rekap = [];
$total_pendapatan = 0;
$total_pelanggan = 0;

$mulai = $_GET['mulai'] ?? '';
$selesai = $_GET['selesai'] ?? '';

if (!empty($mulai) && !empty($selesai)) {
    $q = "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian 
        FROM transaksi 
        WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai' 
        GROUP BY DATE(waktu_transaksi) 
        ORDER BY tgl ASC";
    $res = mysqli_query($koneksi, $q);
    while ($r = mysqli_fetch_assoc($res)) {
        $labels[] = $r['tgl'];
        $data_total[] = $r['total_harian'];
        $rekap[] = $r;
        $total_pendapatan += $r['total_harian'];
    }

    $qp = "SELECT COUNT(DISTINCT pelanggan_id) AS jml 
        FROM transaksi 
        WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'";
    $rp = mysqli_fetch_assoc(mysqli_query($koneksi, $qp));
    $total_pelanggan = $rp['jml'] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan Modern</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --success: #059669;
            --success-hover: #047857;
            --bg-body: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        h1, h2 {
            color: var(--text-main);
            font-weight: 600;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid var(--border-color);
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="date"] {
            padding: 10px 14px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        input[type="date"]:focus {
            border-color: var(--primary);
        }

        button, .btn {
            padding: 10px 20px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s, transform 0.1s;
        }

        button:hover, .btn:hover {
            background-color: var(--primary-hover);
        }

        .btn-success {
            background-color: var(--success);
        }

        .btn-success:hover {
            background-color: var(--success-hover);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .chart-container {
            position: relative;
            width: 100%;
            height: 380px;
            margin-top: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            overflow: hidden;
            border-radius: 8px;
        }

        th, td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        th {
            background-color: #f1f5f9;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 24px;
        }

        .summary-box {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2);
        }

        .summary-box.alt {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            box-shadow: 0 4px 10px rgba(5, 150, 105, 0.2);
        }

        .summary-box .title {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }

        .summary-box .value {
            font-size: 20px;
            font-weight: 700;
            margin-top: 8px;
        }

        .empty-state {
            text-align: center;
            padding: 30px;
            color: var(--text-muted);
            font-style: italic;
        }

        @media print {
            .no-print { display: none !important; }
            body { background: white; padding: 0; }
            .card { box-shadow: none; border: none; padding: 0; margin: 0; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card no-print">
        <h1>Filter Laporan Penjualan</h1>
        <form method="GET">
            <div class="form-group">
                <label>Dari Tanggal</label>
                <input type="date" name="mulai" value="<?= htmlspecialchars($mulai) ?>" required>
            </div>
            <div class="form-group">
                <label>Sampai Tanggal</label>
                <input type="date" name="selesai" value="<?= htmlspecialchars($selesai) ?>" required>
            </div>
            <button type="submit">Tampilkan Laporan</button>
        </form>
        
        <?php if (!empty($mulai) && !empty($selesai)): ?>
            <div class="action-buttons">
                <button onclick="window.print()">Cetak Dokumen</button>
                <a class="btn btn-success" href="export_excel.php?mulai=<?= urlencode($mulai) ?>&selesai=<?= urlencode($selesai) ?>">Ekspor ke Excel</a>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($mulai) && !empty($selesai)): ?>
        <div class="card">
            <h2>Grafik Pendapatan Harian</h2>
            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($labels); ?>,
                    datasets: [{
                        label: 'Total Penjualan (Rp)',
                        data: <?= json_encode($data_total); ?>,
                        backgroundColor: 'rgba(79, 70, 229, 0.8)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 1,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9' }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        </script>

        <div class="card">
            <h2>Tabel Rekapitulasi Harian</h2>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($rekap)): ?>
                        <tr><td colspan="3" class="empty-state">Tidak ada data transaksi pada rentang tanggal tersebut.</td></tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($rekap as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d M Y', strtotime($row['tgl'])); ?></td>
                            <td><strong>Rp. <?= number_format($row['total_harian'], 0, ',', '.'); ?></strong></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="summary-grid">
                <div class="summary-box">
                    <div class="title">Jumlah Pelanggan Unik</div>
                    <div class="value"><?= $total_pelanggan; ?> Orang</div>
                </div>
                <div class="summary-box alt">
                    <div class="title">Total Pendapatan Keseluruhan</div>
                    <div class="value">Rp. <?= number_format($total_pendapatan, 0, ',', '.'); ?></div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="card empty-state">
            Silakan tentukan rentang tanggal di atas lalu klik tombol <b>Tampilkan Laporan</b> untuk melihat hasil rekapitulasi.
        </div>
    <?php endif; ?>
</div>

</body>
</html>