<?php
include "koneksi.php";

$tanggal_mulai = $_GET['tanggal_mulai'] ?? '';
$tanggal_selesai = $_GET['tanggal_selesai'] ?? '';

function tanggalValidExcel($tanggal) {
    $hasil = DateTime::createFromFormat('!Y-m-d', $tanggal);
    return $hasil && $hasil->format('Y-m-d') === $tanggal;
}

if (
    !tanggalValidExcel($tanggal_mulai) ||
    !tanggalValidExcel($tanggal_selesai) ||
    $tanggal_mulai > $tanggal_selesai
) {
    die("Tanggal tidak valid.");
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

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
?>

<table border="1">
    <tr>
        <th colspan="3">LAPORAN PENJUALAN</th>
    </tr>

    <tr>
        <th colspan="3">
            Periode <?php echo htmlspecialchars($tanggal_mulai); ?>
            sampai <?php echo htmlspecialchars($tanggal_selesai); ?>
        </th>
    </tr>
    <tr>
        <th>No</th>
        <th>Total Pendapatan</th>
        <th>Tanggal Transaksi</th>
    </tr>
    <?php
    $no = 1;
    $total = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $total += $row['total_pendapatan'];
    ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['total_pendapatan']; ?></td>
            <td><?php echo $row['waktu_transaksi']; ?></td>
        </tr>
    <?php } ?>

    <tr>
        <th colspan="2">Total Pendapatan Keseluruhan</th>
        <th><?php echo $total; ?></th>
    </tr>
</table>
