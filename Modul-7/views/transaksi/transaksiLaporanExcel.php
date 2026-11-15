<?php
// Ambil parameter tanggal dari URL (Metode GET)
$tglAwal = $_GET['tglAwal'] ?? date('Y-m-01');
$tglAkhir = $_GET['tglAkhir'] ?? date('Y-m-d');

// Query data berdasarkan rentang tanggal
$stmt = $conn->prepare("SELECT tanggal, COUNT(id) AS total_transaksi, SUM(total) AS total_pendapatan 
                        FROM transaksi 
                        WHERE tanggal BETWEEN ? AND ? 
                        GROUP BY tanggal 
                        ORDER BY tanggal ASC");
$stmt->bind_param("ss", $tglAwal, $tglAkhir);
$stmt->execute();
$result = $stmt->get_result();
$transaksi = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Header HTTP untuk memaksa browser mengunduh file CSV (Tambahkan tanda $ di depan filename)
$filename = "Laporan_Transaksi_" . $tglAwal . "_sampai_" . $tglAkhir . ".csv";
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Buka output stream
$output = fopen('php://output', 'w');

// Tulis baris Judul / Header Kolom CSV
fputcsv($output, ['No', 'Tanggal', 'Jumlah Transaksi', 'Total Pendapatan']);

$no = 1;
$grandTotal = 0;

foreach ($transaksi as $row) {
    $grandTotal += (float)$row['total_pendapatan'];
    fputcsv($output, [
        $no++,
        $row['tanggal'],
        $row['total_transaksi'] . ' transaksi',
        $row['total_pendapatan']
    ]);
}

// Baris Total Keseluruhan di bagian bawah
fputcsv($output, []);
fputcsv($output, ['', 'Total Pendapatan Keseluruhan', '', $grandTotal]);

fclose($output);
exit;