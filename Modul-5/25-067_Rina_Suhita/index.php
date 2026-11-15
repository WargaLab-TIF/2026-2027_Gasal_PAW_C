<?php
require 'koneksi.php';

$hasil = mysqli_query($koneksi, "SELECT id, nama, telp, alamat FROM supplier ORDER BY id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Data Master Supplier</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<body>
<div style="height:46px; background:linear-gradient(#0b5cab, #06407c); margin-bottom:28px;">
  <span style="color:#fff; font-size:16px; line-height:46px; margin-left:20px;">Aplikasi Penjualan</span>
</div>

<div class="container">

  <div class="clearfix">
    <h3 class="pull-left" style="color:#3b86b0">Data Master Supplier</h3>
    <a href="tambah.php" class="btn btn-success btn-sm pull-right" style="margin-top:20px">Tambah Data</a>
  </div>
  <hr>

  <table class="table table-bordered">
    <thead>
      <tr class="info">
        <th>No</th>
        <th>Nama</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th>Tindakan</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($row = mysqli_fetch_assoc($hasil)) { ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= e($row['nama']) ?></td>
        <td><?= e($row['telp']) ?></td>
        <td><?= e($row['alamat']) ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-xs">Edit</a>
            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-xs"
                onclick="return confirm('Anda yakin akan menghapus supplier ini?');">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

</div>
</body>
</html>