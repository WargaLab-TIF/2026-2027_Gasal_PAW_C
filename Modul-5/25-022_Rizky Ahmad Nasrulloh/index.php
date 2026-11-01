<?php
/**
 * Modul 5 : Database - Tugas Praktikum
 * Nama : Rizky Ahmad Nasrulloh
 * NIM  : 25-022
 *
 * Satu file berisi koneksi database, router sederhana, proses CRUD supplier,
 * dan tampilan (HTML + CSS).
 *
 * URL:
 *   index.php                     -> daftar supplier
 *   index.php?action=tambah       -> form tambah
 *   index.php?action=edit&id=1    -> form edit
 *   index.php?action=hapus&id=1   -> hapus data
 */

declare(strict_types=1);

// ---------------------------------------------------------------------
// Konfigurasi database (default XAMPP)
// ---------------------------------------------------------------------
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'tp5_praktikum';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $ex) {
    http_response_code(500);
    exit(
        '<h1>Koneksi database gagal</h1>'
        . '<p>' . htmlspecialchars($ex->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>'
        . '<p>Pastikan MySQL sudah berjalan dan file <code>database/tp5_praktikum.sql</code> sudah diimpor.</p>'
    );
}

// ---------------------------------------------------------------------
// Helper
// ---------------------------------------------------------------------
function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}

function ambilSupplier(mysqli $conn, int $id): ?array
{
    $stmt = $conn->prepare('SELECT id, nama, telp, alamat FROM supplier WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $row ?: null;
}

// ---------------------------------------------------------------------
// Router
// ---------------------------------------------------------------------
$action    = $_GET['action'] ?? 'list';
$errors    = [];
$form      = ['id' => 0, 'nama' => '', 'telp' => '', 'alamat' => ''];
$supplier  = null;
$suppliers = [];

switch ($action) {
    case 'hapus':
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            try {
                $stmt = $conn->prepare('DELETE FROM supplier WHERE id = ?');
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->close();
            } catch (mysqli_sql_exception $ex) {
                // misalnya masih dipakai data lain yang tidak di-set SET NULL / CASCADE
                redirect('index.php?status=gagal');
            }
        }
        redirect('index.php?status=hapus');

    case 'tambah':
    case 'edit':
        $isEdit = ($action === 'edit');

        if ($isEdit) {
            $id       = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $supplier = $id ? ambilSupplier($conn, $id) : null;

            if ($supplier === null) {
                redirect('index.php?status=tidakada');
            }
            $form = $supplier;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $form['nama']   = trim((string) ($_POST['nama'] ?? ''));
            $form['telp']   = trim((string) ($_POST['telp'] ?? ''));
            $form['alamat'] = trim((string) ($_POST['alamat'] ?? ''));

            if ($form['nama'] === '') {
                $errors['nama'] = 'Nama supplier tidak boleh kosong.';
            } elseif (mb_strlen($form['nama']) < 3 || mb_strlen($form['nama']) > 100) {
                $errors['nama'] = 'Nama supplier harus 3 sampai 100 karakter.';
            }

            if ($form['telp'] === '') {
                $errors['telp'] = 'Telp tidak boleh kosong.';
            } elseif (!preg_match('/^[0-9]{6,12}$/', $form['telp'])) {
                $errors['telp'] = 'Telp harus berupa angka, 6 sampai 12 digit.';
            }

            if (!$errors) {
                if ($isEdit) {
                    $stmt = $conn->prepare('UPDATE supplier SET nama = ?, telp = ?, alamat = ? WHERE id = ?');
                    $stmt->bind_param('sssi', $form['nama'], $form['telp'], $form['alamat'], $supplier['id']);
                } else {
                    $stmt = $conn->prepare('INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)');
                    $stmt->bind_param('sss', $form['nama'], $form['telp'], $form['alamat']);
                }
                $stmt->execute();
                $stmt->close();

                redirect('index.php?status=' . ($isEdit ? 'edit' : 'tambah'));
            }
        }
        break;

    default:
        $action    = 'list';
        $suppliers = $conn->query('SELECT id, nama, telp, alamat FROM supplier ORDER BY id')
            ->fetch_all(MYSQLI_ASSOC);
}

// ---------------------------------------------------------------------
// Notifikasi
// ---------------------------------------------------------------------
$pesan = [
    'tambah'    => ['sukses', 'Data supplier berhasil ditambahkan.'],
    'edit'      => ['sukses', 'Data supplier berhasil diperbarui.'],
    'hapus'     => ['sukses', 'Data supplier berhasil dihapus.'],
    'tidakada'  => ['error', 'Data supplier tidak ditemukan.'],
    'gagal'     => ['error', 'Data supplier gagal dihapus karena masih dipakai data lain.'],
];
$status     = $_GET['status'] ?? '';
$notifikasi = $pesan[$status] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $action === 'list' ? 'Data Master Supplier' : 'Form Supplier' ?></title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 24px 16px;
            font-family: "Segoe UI", Arial, sans-serif;
            font-size: 15px;
            color: #1f2933;
            background: #f4f6f8;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 24px 28px 32px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .08);
        }
        h1 { margin: 0 0 4px; font-size: 22px; }
        h2 { margin: 0 0 16px; font-size: 18px; }
        .subjudul { margin: 0 0 20px; color: #616e7c; font-size: 13px; }
        .notif {
            margin-bottom: 16px;
            padding: 10px 14px;
            border-radius: 6px;
            font-size: 14px;
        }
        .notif.sukses { background: #e3f9e5; border: 1px solid #a3e0a8; color: #1d6b25; }
        .notif.error  { background: #ffe9e9; border: 1px solid #f5b5b5; color: #a61b1b; }
        .toolbar { margin-bottom: 14px; }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th, td {
            padding: 9px 12px;
            border: 1px solid #d9e2ec;
            text-align: left;
            vertical-align: top;
        }
        th { background: #eef2f7; font-weight: 600; }
        tbody tr:nth-child(even) { background: #fafcfe; }
        td.no, th.no { width: 46px; text-align: center; }
        td.tindakan { width: 130px; white-space: nowrap; }
        a { color: #1a6fb5; }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            border: 0;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-primary { background: #1a6fb5; color: #fff; }
        .btn-primary:hover { background: #145a94; }
        .btn-secondary { background: #e4e7eb; color: #323f4b; margin-left: 6px; }
        .btn-secondary:hover { background: #d3d9e0; }
        .link-edit { margin-right: 10px; }
        .link-hapus { color: #c62828; }
        .form-group { margin-bottom: 14px; }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 14px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #bcccdc;
            border-radius: 5px;
            font-family: inherit;
            font-size: 14px;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1a6fb5;
            box-shadow: 0 0 0 2px rgba(26, 111, 181, .15);
        }
        .form-error { margin: 4px 0 0; color: #c62828; font-size: 13px; }
        .kosong { text-align: center; color: #616e7c; font-style: italic; }
    </style>
</head>
<body>
<main class="container">
    <h1>Data Master Supplier</h1>
    <p class="subjudul">Modul 5 &middot; Praktikum Pengembangan Aplikasi Web C &middot; NIM 25-022</p>

    <?php if ($notifikasi !== null): ?>
        <div class="notif <?= e($notifikasi[0]) ?>"><?= e($notifikasi[1]) ?></div>
    <?php endif; ?>

    <?php if ($action === 'list'): ?>
        <div class="toolbar">
            <a class="btn btn-primary" href="index.php?action=tambah">Tambah Data</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="no">No</th>
                    <th>Nama</th>
                    <th>Telp</th>
                    <th>Alamat</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$suppliers): ?>
                    <tr>
                        <td colspan="5" class="kosong">Belum ada data supplier.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($suppliers as $index => $row): ?>
                    <tr>
                        <td class="no"><?= $index + 1 ?></td>
                        <td><?= e($row['nama']) ?></td>
                        <td><?= e($row['telp']) ?></td>
                        <td><?= e($row['alamat']) ?></td>
                        <td class="tindakan">
                            <a class="link-edit" href="index.php?action=edit&amp;id=<?= (int) $row['id'] ?>">Edit</a>
                            <a class="link-hapus"
                               href="index.php?action=hapus&amp;id=<?= (int) $row['id'] ?>"
                               onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <h2><?= $action === 'edit' ? 'Edit Data Master Supplier' : 'Tambah Data Master Supplier Baru' ?></h2>

        <form method="post" action="index.php?action=<?= e($action) ?><?= $action === 'edit' ? '&amp;id=' . (int) $supplier['id'] : '' ?>">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" maxlength="100" value="<?= e($form['nama']) ?>" autofocus>
                <?php if (isset($errors['nama'])): ?>
                    <p class="form-error"><?= e($errors['nama']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="telp">Telp</label>
                <input type="text" id="telp" name="telp" maxlength="12" value="<?= e($form['telp']) ?>">
                <?php if (isset($errors['telp'])): ?>
                    <p class="form-error"><?= e($errors['telp']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3"><?= e($form['alamat']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary"><?= $action === 'edit' ? 'Update' : 'Simpan' ?></button>
            <a class="btn btn-secondary" href="index.php">Batal</a>
        </form>
    <?php endif; ?>
</main>
</body>
</html>
