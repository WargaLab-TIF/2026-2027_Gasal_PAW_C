<?php
include "koneksi.php";

$tanggal_mulai = $_GET['tanggal_mulai'] ?? date('Y-m-01');
$tanggal_selesai = $_GET['tanggal_selesai'] ?? date('Y-m-d');

function tanggalValid($tanggal) {
    $hasil = DateTime::createFromFormat('!Y-m-d', $tanggal);
    return $hasil && $hasil->format('Y-m-d') === $tanggal;
}

if (
    !tanggalValid($tanggal_mulai) ||
    !tanggalValid($tanggal_selesai) ||
    $tanggal_mulai > $tanggal_selesai
) {
    die("Tanggal tidak valid. Silakan kembali dan pilih rentang tanggal yang benar.");
}

$sql = "SELECT
            waktu_transaksi,
            SUM(total) AS total_pendapatan
        FROM transaksi
        WHERE waktu_transaksi BETWEEN ? AND ?
        GROUP BY waktu_transaksi
        ORDER BY waktu_transaksi ASC";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "ss", $tanggal_mulai, $tanggal_selesai);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$tanggal = [];
$pendapatan = [];
$no = 1;
$total_tabel = 0;
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

<div class="container">

    <h2>LAPORAN PENJUALAN</h2>

    <p class="periode">
        Periode:
        <?php echo date('d-m-Y', strtotime($tanggal_mulai)); ?>
        sampai
        <?php echo date('d-m-Y', strtotime($tanggal_selesai)); ?>
    </p>
    <div class="filter">
        <form method="GET" action="">
            <div>
                <label>Tanggal Mulai</label>
                <input
                    type="date"
                    name="tanggal_mulai"
                    value="<?php echo htmlspecialchars($tanggal_mulai); ?>"
                    required
                >
            </div>

            <div>
                <label>Tanggal Selesai</label>
                <input
                    type="date"
                    name="tanggal_selesai"
                    value="<?php echo htmlspecialchars($tanggal_selesai); ?>"
                    required
                >
            </div>

            <button type="submit">Tampilkan</button>
        </form>
    </div>
    <div class="tombol">
        <button type="button" onclick="window.print()">Cetak</button>

        <a href="export_excel.php?tanggal_mulai=<?php echo urlencode($tanggal_mulai); ?>&tanggal_selesai=<?php echo urlencode($tanggal_selesai); ?>">
            <button type="button">Export Excel</button>
        </a>
    </div>

    <h3>Grafik Penjualan Harian</h3>
    <div class="grafik">
        <canvas id="grafikPenjualan"></canvas>
    </div>
    <h3>Rekapitulasi Penjualan</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Total Pendapatan</th>
            <th>Tanggal Transaksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <?php
            $tanggal[] = $row['waktu_transaksi'];
            $pendapatan[] = (int) $row['total_pendapatan'];
            $total_tabel += $row['total_pendapatan'];
            ?>

            <tr>
                <td><?php echo $no++; ?></td>
                <td>
                    Rp <?php echo number_format($row['total_pendapatan'], 0, ',', '.'); ?>
                </td>
                <td>
                    <?php echo date('d-m-Y', strtotime($row['waktu_transaksi'])); ?>
                </td>
            </tr>
        <?php } ?>

        <?php if ($no == 1) { ?>
            <tr>
                <td colspan="3">Tidak ada transaksi pada periode ini.</td>
            </tr>
        <?php } ?>
    </table>

    <?php
    $sql_ringkasan = "SELECT
        COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan,
        COALESCE(SUM(total), 0) AS total_pendapatan
        FROM transaksi
        WHERE waktu_transaksi BETWEEN ? AND ?";

    $stmt_ringkasan = mysqli_prepare($koneksi, $sql_ringkasan);
    mysqli_stmt_bind_param($stmt_ringkasan, "ss", $tanggal_mulai, $tanggal_selesai);
    mysqli_stmt_execute($stmt_ringkasan);
    $ringkasan = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_ringkasan));
    ?>

    <h3>Ringkasan Penjualan</h3>

    <div class="ringkasan">
        <div class="card">
            <h4>Jumlah Pelanggan Unik</h4>
            <h2><?php echo $ringkasan['jumlah_pelanggan']; ?></h2>
        </div>

        <div class="card">
            <h4>Total Pendapatan Keseluruhan</h4>
            <h2>
                Rp <?php echo number_format($ringkasan['total_pendapatan'], 0, ',', '.'); ?>
            </h2>
        </div>
    </div>

</div>

<script>
const tanggal = <?php echo json_encode($tanggal); ?>;
const pendapatan = <?php echo json_encode($pendapatan); ?>;

new Chart(document.getElementById('grafikPenjualan'), {
    type: 'bar',

    data: {
        labels: tanggal,
        datasets: [{
            label: 'Total Pendapatan',
            data: pendapatan,
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgb(54, 162, 235)',
            borderWidth: 1
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
                    text: 'Total Pendapatan (Rupiah)'
                },
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

</body>
</html>
