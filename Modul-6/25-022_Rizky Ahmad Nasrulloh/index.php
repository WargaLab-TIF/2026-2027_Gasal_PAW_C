<?php
/**
 * Modul 6 : Pengelolaan Master Detil Data
 * Nama : Rizky Ahmad Nasrulloh
 * NIM  : 25-022
 *
 * Halaman master-detail transaksi.
 *   index.php                              -> transaksi pertama + detail
 *   index.php?id=3                         -> transaksi #3 + detail
 *   index.php?id=3 (POST aksi=tambah_detail) -> simpan detail + update total
 */

declare(strict_types=1);

require __DIR__ . '/koneksi.php';

$aksi   = (string) ($_POST['aksi'] ?? '');
$errors = [];
$form   = ['barang_id' => 0, 'qty' => 1];

$transaksiId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$transaksiId) {
    $transaksiId = filter_input(INPUT_POST, 'transaksi_id', FILTER_VALIDATE_INT);
}
$transaksiId = $transaksiId ?: null;

// ---------------------------------------------------------------------
// Proses simpan detail transaksi
// ---------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $aksi === 'tambah_detail') {
    $transaksiId = filter_input(INPUT_POST, 'transaksi_id', FILTER_VALIDATE_INT) ?: null;
    $barangId    = filter_input(INPUT_POST, 'barang_id', FILTER_VALIDATE_INT) ?: 0;
    $qty         = filter_input(INPUT_POST, 'qty', FILTER_VALIDATE_INT) ?: 0;

    $form = ['barang_id' => $barangId, 'qty' => $qty];

    if ($transaksiId === null) {
        $errors['umum'] = 'Transaksi tidak valid.';
    } else {
        $stmt = $conn->prepare('SELECT id FROM transaksi WHERE id = ?');
        $stmt->bind_param('i', $transaksiId);
        $stmt->execute();
        if ($stmt->get_result()->fetch_row() === null) {
            $errors['umum'] = 'Transaksi tidak ditemukan.';
        }
        $stmt->close();
    }

    $barang = null;
    if ($barangId <= 0) {
        $errors['barang_id'] = 'Pilih barang terlebih dahulu.';
    } else {
        $stmt = $conn->prepare('SELECT id, harga FROM barang WHERE id = ?');
        $stmt->bind_param('i', $barangId);
        $stmt->execute();
        $barang = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($barang === null) {
            $errors['barang_id'] = 'Barang tidak ditemukan.';
        }
    }

    if ($qty < 1) {
        $errors['qty'] = 'Qty minimal 1.';
    }

    if (!$errors) {
        $stmt = $conn->prepare(
            'SELECT 1 FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ? LIMIT 1'
        );
        $stmt->bind_param('ii', $transaksiId, $barangId);
        $stmt->execute();
        if ($stmt->get_result()->fetch_row() !== null) {
            $errors['barang_id'] = 'Barang tersebut sudah ada pada detail transaksi ini.';
        }
        $stmt->close();
    }

    if (!$errors) {
        $harga = (int) $barang['harga'];

        $conn->begin_transaction();
        try {
            $stmt = $conn->prepare(
                'INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)'
            );
            $stmt->bind_param('iiii', $transaksiId, $barangId, $harga, $qty);
            $stmt->execute();
            $stmt->close();

            $stmt = $conn->prepare(
                'UPDATE transaksi
                    SET total = (
                        SELECT COALESCE(SUM(harga * qty), 0)
                        FROM transaksi_detail
                        WHERE transaksi_id = ?
                    )
                  WHERE id = ?'
            );
            $stmt->bind_param('ii', $transaksiId, $transaksiId);
            $stmt->execute();
            $stmt->close();

            $conn->commit();
        } catch (mysqli_sql_exception $ex) {
            $conn->rollback();
            $status = ((int) $ex->getCode() === 1062) ? 'duplikat' : 'gagal';
            redirect('index.php?id=' . $transaksiId . '&status=' . $status);
        }

        redirect('index.php?id=' . $transaksiId . '&status=tambah');
    }
}

// ---------------------------------------------------------------------
// Ambil data master dan detail
// ---------------------------------------------------------------------
$transaksiList = $conn->query(
    'SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, t.pelanggan_id, p.nama AS pelanggan_nama
       FROM transaksi t
       JOIN pelanggan p ON p.id = t.pelanggan_id
      ORDER BY t.id'
)->fetch_all(MYSQLI_ASSOC);

$transaksi = null;
if ($transaksiId === null && $transaksiList) {
    $transaksiId = (int) $transaksiList[0]['id'];
}

foreach ($transaksiList as $row) {
    if ((int) $row['id'] === $transaksiId) {
        $transaksi = $row;
        break;
    }
}

if ($transaksi === null && $transaksiList) {
    redirect('index.php?status=tidakada');
}

$details = [];
$barangTersedia = [];

if ($transaksi !== null) {
    $stmt = $conn->prepare(
        'SELECT d.barang_id, b.kode_barang, b.nama_barang, d.harga, d.qty, (d.harga * d.qty) AS subtotal
           FROM transaksi_detail d
           JOIN barang b ON b.id = d.barang_id
          WHERE d.transaksi_id = ?
          ORDER BY b.nama_barang'
    );
    $stmt->bind_param('i', $transaksiId);
    $stmt->execute();
    $details = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    $stmt = $conn->prepare(
        'SELECT b.id, b.kode_barang, b.nama_barang, b.harga
           FROM barang b
          WHERE b.id NOT IN (
                SELECT barang_id FROM transaksi_detail WHERE transaksi_id = ?
          )
          ORDER BY b.nama_barang'
    );
    $stmt->bind_param('i', $transaksiId);
    $stmt->execute();
    $barangTersedia = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// ---------------------------------------------------------------------
// Notifikasi
// ---------------------------------------------------------------------
$pesan = [
    'tambah'   => ['sukses', 'Detail transaksi berhasil disimpan. Total transaksi sudah diperbarui.'],
    'duplikat' => ['error', 'Barang tersebut sudah ada pada detail transaksi ini.'],
    'gagal'    => ['error', 'Detail transaksi gagal disimpan.'],
    'tidakada' => ['error', 'Transaksi tidak ditemukan.'],
];
$status     = (string) ($_GET['status'] ?? '');
$notifikasi = $pesan[$status] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Master Detil Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container">
    <h1>Master Detil Transaksi</h1>
    <p class="subjudul">Modul 6 &middot; Praktikum Pengembangan Aplikasi Web C &middot; NIM 25-022</p>

    <p class="nav">
        <span class="aktif">Transaksi</span>
        <span class="pemisah">|</span>
        <a href="barang.php">Data Barang</a>
    </p>

    <?php if ($notifikasi !== null): ?>
        <div class="notif <?= e($notifikasi[0]) ?>"><?= e($notifikasi[1]) ?></div>
    <?php endif; ?>

    <?php if (!$transaksiList): ?>
        <p class="kosong">Belum ada data transaksi.</p>
    <?php else: ?>
        <form method="get" action="index.php" class="pilih-master">
            <div>
                <label for="id">Pilih Transaksi (Master)</label>
                <select id="id" name="id">
                    <?php foreach ($transaksiList as $row): ?>
                        <option value="<?= (int) $row['id'] ?>" <?= (int) $row['id'] === $transaksiId ? 'selected' : '' ?>>
                            #<?= (int) $row['id'] ?> &middot; <?= e($row['waktu_transaksi']) ?> &middot;
                            <?= e($row['pelanggan_nama']) ?> &middot; <?= e(rupiah($row['total'])) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Load</button>
            </div>
        </form>

        <section class="master">
            <dl>
                <dt>No. Transaksi</dt>
                <dd>#<?= (int) $transaksi['id'] ?></dd>

                <dt>Tanggal</dt>
                <dd><?= e($transaksi['waktu_transaksi']) ?></dd>

                <dt>Pelanggan</dt>
                <dd><?= e($transaksi['pelanggan_id']) ?> &middot; <?= e($transaksi['pelanggan_nama']) ?></dd>

                <dt>Keterangan</dt>
                <dd><?= e($transaksi['keterangan'] ?? '-') ?></dd>

                <dt>Total</dt>
                <dd class="total"><?= e(rupiah($transaksi['total'])) ?></dd>
            </dl>
        </section>

        <h2>Detail Barang</h2>

        <table>
            <thead>
                <tr>
                    <th class="no">No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th class="angka">Harga</th>
                    <th class="angka">Qty</th>
                    <th class="angka">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$details): ?>
                    <tr>
                        <td colspan="6" class="kosong">Belum ada detail barang pada transaksi ini.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($details as $index => $row): ?>
                    <tr>
                        <td class="no"><?= $index + 1 ?></td>
                        <td><?= e($row['kode_barang']) ?></td>
                        <td><?= e($row['nama_barang']) ?></td>
                        <td class="angka"><?= e(rupiah($row['harga'])) ?></td>
                        <td class="angka"><?= (int) $row['qty'] ?></td>
                        <td class="angka"><?= e(rupiah($row['subtotal'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="angka">Total Transaksi</td>
                    <td class="angka"><?= e(rupiah($transaksi['total'])) ?></td>
                </tr>
            </tfoot>
        </table>

        <section class="form-detail">
            <h2>Tambah Detail Transaksi</h2>

            <?php if (isset($errors['umum'])): ?>
                <p class="form-error"><?= e($errors['umum']) ?></p>
            <?php endif; ?>

            <?php if (!$barangTersedia): ?>
                <div class="info-kosong">
                    Semua barang sudah masuk ke transaksi ini, tidak ada barang lain yang bisa dipilih.
                </div>
            <?php else: ?>
                <form method="post" action="index.php?id=<?= (int) $transaksi['id'] ?>">
                    <input type="hidden" name="aksi" value="tambah_detail">
                    <input type="hidden" name="transaksi_id" value="<?= (int) $transaksi['id'] ?>">

                    <div class="form-row">
                        <div class="form-group barang">
                            <label for="barang_id">Barang</label>
                            <select id="barang_id" name="barang_id">
                                <option value="">-- pilih barang --</option>
                                <?php foreach ($barangTersedia as $barang): ?>
                                    <option value="<?= (int) $barang['id'] ?>"
                                        <?= (int) $form['barang_id'] === (int) $barang['id'] ? 'selected' : '' ?>>
                                        <?= e($barang['kode_barang']) ?> &middot; <?= e($barang['nama_barang']) ?>
                                        (<?= e(rupiah($barang['harga'])) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($errors['barang_id'])): ?>
                                <p class="form-error"><?= e($errors['barang_id']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group qty">
                            <label for="qty">Qty</label>
                            <input type="number" id="qty" name="qty" min="1" step="1"
                                   value="<?= max(1, (int) $form['qty']) ?>">
                            <?php if (isset($errors['qty'])): ?>
                                <p class="form-error"><?= e($errors['qty']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group tombol">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </section>
    <?php endif; ?>
</main>
</body>
</html>
