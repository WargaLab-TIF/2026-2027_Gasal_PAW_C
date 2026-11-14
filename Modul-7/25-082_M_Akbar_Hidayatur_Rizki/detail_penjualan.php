<?php
include 'koneksi.php';


$tglAwal = $_POST['tglAwal'] ?? '';
$tglAkhir = $_POST['tglAkhir'] ?? '';

if (!empty($tglAwal) && !empty($tglAkhir)){
    $query = "
    SELECT
        MONTH(waktu_transaksi) AS bulan,
        DAY(waktu_transaksi) AS tanggal,
        YEAR(waktu_transaksi) AS tahun,
        COUNT(id) AS total_transaksi,
        SUM(total) AS total_pendapatan
    FROM transaksi
    WHERE waktu_transaksi BETWEEN ? AND ?
    GROUP BY DAY(waktu_transaksi) , MONTH(waktu_transaksi)
    ORDER BY tahun ASC , bulan ASC, tanggal ASC
        ";

    $queryP = "
    SELECT COUNT(DISTINCT pelanggan_id) jumlah_pelanggan, SUM(total) total_pendapatan
    FROM transaksi
    WHERE waktu_transaksi BETWEEN ? AND ?
    ORDER BY YEAR(waktu_transaksi) ASC ,MONTH(waktu_transaksi) ASC, DAY(waktu_transaksi) ASC
    ";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $tglAwal, $tglAkhir);
    $stmt->execute();
    $hasil = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $stmt1 = $koneksi->prepare($queryP);
    $stmt1->bind_param("ss", $tglAwal, $tglAkhir);
    $stmt1->execute();

    $hasil1 = $stmt1->get_result()->fetch_all(MYSQLI_ASSOC);

} else {
    $query = "
    SELECT
        MONTH(waktu_transaksi) AS bulan,
        DAY(waktu_transaksi) AS tanggal,
        YEAR(waktu_transaksi) AS tahun,
        COUNT(id) AS total_transaksi,
        SUM(total) AS total_pendapatan
    FROM transaksi tr
    GROUP BY DAY(waktu_transaksi) , MONTH(waktu_transaksi)
    ORDER BY tahun ASC , bulan ASC, tanggal ASC
        ";

    $queryP = "
    SELECT COUNT(DISTINCT pelanggan_id) jumlah_pelanggan, SUM(total) total_pendapatan
    FROM transaksi
    ";
    $hasil1 = mysqli_query($koneksi, $queryP);
    $hasil = mysqli_query($koneksi,  $query);
}






$namaBulan = [
    1=>'Januari',
    2=>'Februari',
    3=>'Maret',
    4=>'April',
    5=>'Mei',
    6=>'Juni',
    7=>'Juli',
    8=>'Agustus',
    9=>'September',
    10=>'Oktober',
    11=>'November',
    12=>'Desember'
];


$labels = [];
$dataTotal = [];

foreach ($hasil as $row) {
    $labels[] = $row['tanggal'] . ' ' . $namaBulan[(int)$row['bulan']] . ' ' . $row['tahun'];
    $dataTotal[] = (int) $row['total_pendapatan'];
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.6.1/dist/chart.umd.min.js"></script>
    <style>
        @media print {
            .no-print, form, .kembali-button {
                display: none !important;
            }
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding: 30px;
        }
        #detail {
            background-color: #6D28D9;
            color: white;
            text-align: center;
        }
        #data {
            background-color: #6D28D9;
            color: white;
            text-align: center;
        }
        #tb-detail {
            border-collapse: collapse;
            width: 800px;
            border-color: darkcyan;
            border-radius: 10px;
        }
        #data-pelanggan {
            border-collapse: collapse;
            width: 800px;
            border-color: darkcyan;
            border-radius: 10px;
        }
        .card {
            width: auto;
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            height: 100%;
        }
    
        .card h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }
        .kembali-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #6B7280; /* Warna abu-abu netral elegan */
            color: white;
            padding: 7px 14px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s, transform 0.1s;
            margin-bottom: 15px;
        }

        .kembali-button:hover {
            background-color: #4B5563;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="card">
    <h2>Laporan Penjualan</h2>
    <form method="POST">
        <label>Dari :
            <input type="date" name="tglAwal" value="<?= $tglAwal ?>">
        </label>
        <label> Sampai :
            <input type="date" name="tglAkhir" value="<?= $tglAkhir ?>">
        </label>
        <button type="submit" id="filter">Tampilkan</button>
    </form>
    <br>

    <div class="no-print" style="margin-top: 15px; margin-bottom: 20px; display: flex; gap: 10px;">
        <button type="button" onclick="window.print()" class="btn-cetak">Cetak Laporan</button>
        <a href="export_excel.php?tglAwal=<?= urlencode($tglAwal) ?>&tglAkhir=<?= urlencode($tglAkhir) ?>" class="btn-excel">Ekspor Excel</a>
    </div>    
    <div>
      <canvas id="myChart"></canvas>
    </div>

    <script>
      const ctx = document.getElementById('myChart');
      const data = <?= json_encode($dataTotal); ?>;
      const label = <?= json_encode($labels); ?>;
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: label,
          datasets: [{
            label: '# Total Pendapatan',
            data: data,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
    <table border="1" cellpadding="5" id="tb-detail">
        <thead id="detail">
            <tr>
                <td>No</td>
                <td>Tanggal</td>
                <td>Total Pendapatan</td>
                <td>Total Transaksi</td>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php foreach ($hasil as $d): ?>
                <tr style="text-align: center;">
                    <td> <?= $no ?>.</td>
                    <td> <?= $d["tanggal"] . ' ' . $namaBulan[(int) $d["bulan"]] . ' ' . $d["tahun"] ?> </td>
                    <td> Rp. <?= number_format($d["total_pendapatan"] ?? 0, 0, ',', '.') ?></td>
                    <td> <?= $d["total_transaksi"] ?> </td>
                </tr>
                <?php $no++ ?>
            <?php endforeach ?>
        </tbody>
    </table>

    <br>

    <table border="1" cellpadding="5" id="data-pelanggan">
        <thead id="data">
            <tr>
                <td>Jumlah Pelanggan</td>
                <td>Total Pendapatan Keseluruhan</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hasil1 as $d): ?>
                <tr style="text-align: center;">
                    <td><?= $d['jumlah_pelanggan']?></td>
                    <td>Rp. <?= number_format($d["total_pendapatan"] ?? 0, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
    <br>
    <a href="master-detail.php" class="kembali-button">Kembali</a>
    </div>
</body>
</html>