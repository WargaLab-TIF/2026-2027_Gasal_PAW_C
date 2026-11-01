<?php
require 'koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $telp = trim($_POST['telp'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

    if ($nama === '') {
        $error = 'Nama supplier wajib diisi.';
    } else {
        $stmt = mysqli_prepare(
            $koneksi,
            "INSERT INTO supplier (nama, telp, alamat)
             VALUES (?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $nama,
            $telp,
            $alamat
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit;
        }

        $error = 'Data gagal disimpan.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Supplier</title>
</head>

<body>

<h2>Tambah Data Master Supplier Baru</h2>

<?php if ($error !== '') { ?>
    <p><?= htmlspecialchars($error) ?></p>
<?php } ?>

<form method="post" action="">

    <label>Nama</label>
    <input type="text" name="nama"
           placeholder="Nama supplier" required>
    <br><br>

    <label>Telp</label>
    <input type="text" name="telp"
           placeholder="Telepon">
    <br><br>

    <label>Alamat</label>
    <input type="text" name="alamat"
           placeholder="Alamat">
    <br><br>

    <button type="submit">Simpan</button>

    <a href="index.php">Batal</a>

</form>

</body>
</html>