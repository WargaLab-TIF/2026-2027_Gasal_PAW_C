<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Master Supplier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

    <div class="page-head">
        <h2 class="judul">Data Master Supplier</h2>
        <a href="tambah.php" class="btn btn-success btn-sm">Tambah Data</a>
    </div>

    <?php if (isset($_GET["pesan"])): ?>
        <?php if ($_GET["pesan"] == "tambah"): ?>
            <div class="alert alert-success">Data supplier berhasil ditambahkan.</div>
        <?php elseif ($_GET["pesan"] == "update"): ?>
            <div class="alert alert-success">Data supplier berhasil diperbarui.</div>
        <?php elseif ($_GET["pesan"] == "hapus"): ?>
            <div class="alert alert-success">Data supplier berhasil dihapus.</div>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    $query_supplier  = "SELECT * FROM supplier ORDER BY id ASC";
    $supplier_result = mysqli_query($conn, $query_supplier);
    $no = 1;
    ?>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($supplier_result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($supplier_result)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row["nama"] ?></td>
                <td><?= $row["telp"] ?></td>
                <td><?= $row["alamat"] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row["id"] ?>" class="btn btn-edit btn-xs">Edit</a>
                    <a href="hapus.php?id=<?= $row["id"] ?>" class="btn btn-danger btn-xs"
                       onclick="return confirm('Anda yakin akan menghapus supplier ini?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Belum ada data.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

</div>
</body>
</html>
