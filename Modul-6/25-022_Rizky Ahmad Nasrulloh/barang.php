<?php
/**
 * Modul 6 : Pengelolaan Master Detil Data
 * Nama : Rizky Ahmad Nasrulloh
 * NIM  : 25-022
 *
 * Daftar barang + fitur hapus dengan pengecekan pemakaian pada transaksi_detail.
 *   barang.php               -> daftar barang
 *   barang.php?action=hapus&id=3 -> hapus barang (ditolak jika masih dipakai)
 */

declare(strict_types=1);

require __DIR__ . '/koneksi.php';

$action = (string) ($_GET['action'] ?? 'list');

if ($action === 'hapus') {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$id) {
        redirect('barang.php?status=tidakada');
    }

    $stmt = $conn->prepare('SELECT id, nama_barang FROM barang WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $barang = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($barang === null) {
        redirect('barang.php?status=tidakada');
    }

    $stmt = $conn->prepare('SELECT COUNT(*) AS jumlah FROM transaksi_detail WHERE barang_id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $dipakai = (int) $stmt->get_result()->fetch_assoc()['jumlah'];
    $stmt->close();

    if ($dipakai > 0) {
        redirect('barang.php?status=dipakai&nama=' . urlencode($barang['nama_barang']));
    }

    $stmt = $conn->prepare('DELETE FROM barang WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    redirect('barang.php?status=hapus');
}

$barangList = $conn->query(
    'SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama AS supplier_nama
       FROM barang b
       LEFT JOIN supplier s ON s.id = b.supplier_id
      ORDER BY b.kode_barang'
)->fetch_all(MYSQLI_ASSOC);

$status     = (string) ($_GET['status'] ?? '');
$namaBarang = (string) ($_GET['nama'] ?? '');

$pesan = [
    'hapus'    => ['sukses', 'Data barang berhasil dihapus.'],
    'tidakada' => ['error', 'Data barang tidak ditemukan.'],
];
$notifikasi = $pesan[$status] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container">
    <h1>Data Barang</h1>
    <p class="subjudul">Modul 6 &middot; Praktikum Pengembangan Aplikasi Web C &middot; NIM 25-022</p>

    <p class="nav">
        <a href="index.php">Transaksi</a>
        <span class="pemisah">|</span>
        <span class="aktif">Data Barang</span>
    </p>

    <?php if ($notifikasi !== null): ?>
        <div class="notif <?= e($notifikasi[0]) ?>"><?= e($notifikasi[1]) ?></div>
    <?php endif; ?>

    <?php if ($status === 'dipakai'): ?>
        <div class="notif error">
            Barang<?= $namaBarang !== '' ? ' <strong>' . e($namaBarang) . '</strong>' : '' ?>
            tidak dapat dihapus karena masih digunakan pada transaksi.
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th class="no">No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th class="angka">Harga</th>
                <th class="angka">Stok</th>
                <th>Supplier</th>
                <th class="tindakan">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$barangList): ?>
                <tr>
                    <td colspan="7" class="kosong">Belum ada data barang.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($barangList as $index => $row): ?>
                <tr>
                    <td class="no"><?= $index + 1 ?></td>
                    <td><?= e($row['kode_barang']) ?></td>
                    <td><?= e($row['nama_barang']) ?></td>
                    <td class="angka"><?= e(rupiah($row['harga'])) ?></td>
                    <td class="angka"><?= (int) $row['stok'] ?></td>
                    <td><?= e($row['supplier_nama'] ?? '-') ?></td>
                    <td class="tindakan">
                        <a class="link-hapus"
                           href="barang.php?action=hapus&amp;id=<?= (int) $row['id'] ?>"
                           onclick="return confirm('Anda yakin akan menghapus barang ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
</body>
</html>
