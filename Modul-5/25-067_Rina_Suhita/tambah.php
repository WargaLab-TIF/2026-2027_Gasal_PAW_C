<?php
require 'koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama   = trim($_POST['nama']);
    $telp   = trim($_POST['telp']);
    $alamat = trim($_POST['alamat']);

    if ($nama === '' || $telp === '' || $alamat === '') {
        $error = 'Semua kolom wajib diisi.';
    } else {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $nama, $telp, $alamat);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit;
        }
        $error = 'Gagal menyimpan data: ' . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Tambah Data Master Supplier</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">

  <h2 style="color:#3b86b0">Tambah Data Master Supplier Baru</h2>
  <hr>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
  <?php endif; ?>

  <form method="post" class="form-horizontal">
    <div class="form-group">
      <label class="col-sm-4 control-label">Nama</label>
      <div class="col-sm-5">
        <input type="text" name="nama" class="form-control" placeholder="Nama" maxlength="100" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Telp</label>
      <div class="col-sm-3">
        <input type="text" name="telp" class="form-control" placeholder="telp" maxlength="12" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Alamat</label>
      <div class="col-sm-3">
        <input type="text" name="alamat" class="form-control" placeholder="alamat" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-6">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-danger">Batal</a>
      </div>
    </div>
  </form>

</div>
</body>
</html>