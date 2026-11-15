<?php

declare(strict_types=1);

require __DIR__ . '/laporan.php';

$mulai = is_string($_GET['tanggal_mulai'] ?? null) ? $_GET['tanggal_mulai'] : '';
$selesai = is_string($_GET['tanggal_selesai'] ?? null) ? $_GET['tanggal_selesai'] : '';
$diminta = array_key_exists('tanggal_mulai', $_GET) || array_key_exists('tanggal_selesai', $_GET);
$error = '';
$laporan = null;

if ($diminta) {
    try {
        [$mulai, $selesai] = filterTanggal($_GET);
        $conn = koneksi();
        $laporan = ambilLaporan($conn, $mulai, $selesai);
        $conn->close();
    } catch (InvalidArgumentException $exception) {
        http_response_code(422);
        $error = $exception->getMessage();
    } catch (mysqli_sql_exception $exception) {
        http_response_code(503);
        $error = 'Laporan tidak dapat dimuat. Pastikan MySQL aktif dan database penjualan beserta tabel transaksi sudah tersedia. Periksa konfigurasi koneksi pada laporan.php.';
    }
}

$query = http_build_query(['tanggal_mulai' => $mulai, 'tanggal_selesai' => $selesai]);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Penjualan | Modul 7</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container">
    <header>
        <h1>Laporan Penjualan</h1>
        <p class="subjudul">Modul 7 · Reporting</p>
    </header>
    <form method="get" class="filter no-print" id="filter-laporan">
        <div>
            <label for="tanggal_mulai">Tanggal mulai</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="<?= e($mulai) ?>" required>
        </div>
        <div>
            <label for="tanggal_selesai">Tanggal selesai</label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="<?= e($selesai) ?>" required>
        </div>
        <button type="submit" class="btn primary">Tampilkan</button>
    </form>
    <p id="status-filter" role="status" class="no-print" hidden>Memuat laporan penjualan...</p>

    <?php if ($error !== ''): ?>
        <p class="error" role="alert"><?= e($error) ?></p>
    <?php elseif ($laporan === null): ?>
        <p class="kosong">Pilih tanggal mulai dan tanggal selesai, lalu tekan Tampilkan untuk melihat laporan penjualan.</p>
    <?php else: ?>
        <h2>Rekap Laporan Penjualan <?= e($mulai) ?> sampai <?= e($selesai) ?></h2>
        <div class="actions no-print">
            <button type="button" class="btn" id="cetak">Cetak</button>
            <a class="btn" href="export_excel.php?<?= e($query) ?>">Excel</a>
        </div>
        <?php if ($laporan['rekap'] !== []): ?>
            <section aria-labelledby="judul-grafik">
                <h2 id="judul-grafik">Grafik pendapatan per hari</h2>
                <p id="status-grafik" role="status" class="no-print">Memuat grafik penjualan...</p>
                <div class="chart-container">
                    <canvas id="grafik" role="img" aria-label="Grafik batang pendapatan harian. Rincian angka tersedia pada tabel rekapitulasi di bawah.">Rincian pendapatan tersedia pada tabel rekapitulasi.</canvas>
                </div>
                <noscript><p>Aktifkan JavaScript untuk menampilkan grafik dan tombol cetak. Data tetap tersedia pada tabel.</p></noscript>
            </section>
            <script type="application/json" id="data-grafik"><?= json_encode($laporan['rekap'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) ?></script>
        <?php else: ?>
            <p class="kosong">Tidak ada transaksi pada periode ini. Pilih rentang tanggal lain untuk melihat data penjualan.</p>
        <?php endif; ?>
        <section aria-labelledby="judul-rekap">
            <h2 id="judul-rekap">Rekapitulasi penjualan harian</h2>
            <table>
                <thead><tr><th scope="col" class="no">No</th><th scope="col" class="angka">Total Pendapatan</th><th scope="col">Tanggal Transaksi</th></tr></thead>
                <tbody>
                <?php foreach ($laporan['rekap'] as $index => $row): ?>
                    <tr>
                        <td class="no"><?= $index + 1 ?></td>
                        <td class="angka"><?= rupiah($row['total_harian']) ?></td>
                        <td><?= e($row['tanggal']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if ($laporan['rekap'] === []): ?>
                    <tr><td colspan="3" class="kosong">Tidak ada transaksi.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </section>
        <section class="ringkasan" aria-labelledby="judul-total">
            <h2 id="judul-total">Total periode laporan</h2>
            <dl>
                <div><dt>Jumlah Pelanggan Unik</dt><dd><?= number_format((int) $laporan['ringkasan']['jumlah_pelanggan'], 0, ',', '.') ?> orang</dd></div>
                <div><dt>Total Pendapatan Keseluruhan</dt><dd><?= rupiah($laporan['ringkasan']['total_pendapatan']) ?></dd></div>
            </dl>
        </section>
    <?php endif; ?>
</main>
<script>
'use strict';

const form = document.getElementById('filter-laporan');
const mulai = document.getElementById('tanggal_mulai');
const selesai = document.getElementById('tanggal_selesai');

function validasiTanggal() {
    selesai.setCustomValidity(mulai.value && selesai.value && mulai.value > selesai.value
        ? 'Tanggal selesai tidak boleh sebelum tanggal mulai.'
        : '');
}

mulai.addEventListener('input', validasiTanggal);
selesai.addEventListener('input', validasiTanggal);
form.addEventListener('submit', () => {
    document.getElementById('status-filter').hidden = false;
    form.setAttribute('aria-busy', 'true');
});
window.addEventListener('pageshow', () => {
    document.getElementById('status-filter').hidden = true;
    form.removeAttribute('aria-busy');
});

const cetak = document.getElementById('cetak');
if (cetak) {
    cetak.addEventListener('click', () => window.print());
}

const dataGrafik = document.getElementById('data-grafik');
if (dataGrafik) {
    const status = document.getElementById('status-grafik');
    const canvas = document.getElementById('grafik');
    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.8/dist/chart.umd.min.js';
    script.onerror = () => {
        status.textContent = 'Grafik gagal dimuat. Periksa koneksi internet lalu muat ulang. Rincian tetap tersedia pada tabel.';
        canvas.parentElement.hidden = true;
    };
    script.onload = () => {
        try {
            const rows = JSON.parse(dataGrafik.textContent);
            const currency = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 });
            const chart = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: rows.map(row => row.tanggal),
                    datasets: [{ label: 'Total Pendapatan', data: rows.map(row => Number(row.total_harian)), backgroundColor: '#1a6fb5' }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { callbacks: { label: context => currency.format(context.parsed.y) } }
                    },
                    scales: {
                        x: { title: { display: true, text: 'Tanggal Transaksi' }, ticks: { color: '#1f2933', maxRotation: 45 } },
                        y: { beginAtZero: true, title: { display: true, text: 'Total Pendapatan (Rp)' }, ticks: { color: '#1f2933', callback: value => new Intl.NumberFormat('id-ID').format(value) } }
                    }
                }
            });
            status.hidden = true;
            window.addEventListener('beforeprint', () => chart.resize(800, 265));
            window.addEventListener('afterprint', () => chart.resize());
        } catch (error) {
            script.onerror();
        }
    };
    document.head.appendChild(script);
}
</script>
</body>
</html>
