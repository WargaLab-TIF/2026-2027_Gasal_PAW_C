<?php
require 'koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : (int)$_POST['id'];

// Ambil data supplier yang akan diedit
$stmt = mysqli_prepare($koneksi, "SELECT id, nama, telp, alamat FROM supplier WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama   = trim($_POST['nama']);
    $telp   = trim($_POST['telp']);
    $alamat = trim($_POST['alamat']);

    if ($nama === '' || $telp === '' || $alamat === '') {
        $error = 'Semua kolom wajib diisi.';
        $data['nama'] = $nama; $data['telp'] = $telp; $data['alamat'] = $alamat;
    } else {
        $upd = mysqli_prepare($koneksi, "UPDATE supplier SET nama = ?, telp = ?, alamat = ? WHERE id = ?");
        mysqli_stmt_bind_param($upd, "sssi", $nama, $telp, $alamat, $id);

        if (mysqli_stmt_execute($upd)) {
            header("Location: index.php");
            exit;
        }
        $error = 'Gagal memperbarui data: ' . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Edit Data Master Supplier</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">

  <h2 style="color:#3b86b0">Edit Data Master Supplier</h2>
  <hr>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
  <?php endif; ?>

  <form method="post" class="form-horizontal">
    <input type="hidden" name="id" value="<?= (int)$data['id'] ?>">
    <div class="form-group">
      <label class="col-sm-4 control-label">Nama</label>
      <div class="col-sm-5">
        <input type="text" name="nama" class="form-control" maxlength="100"
               value="<?= e($data['nama']) ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Telp</label>
      <div class="col-sm-3">
        <input type="text" name="telp" class="form-control" maxlength="12"
               value="<?= e($data['telp']) ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Alamat</label>
      <div class="col-sm-3">
        <input type="text" name="alamat" class="form-control"
               value="<?= e($data['alamat']) ?>" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-6">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-danger">Batal</a>
      </div>
    </div>
  </form>

</div>
</body>
</html>