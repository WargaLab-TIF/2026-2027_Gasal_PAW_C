<?php 
include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Master Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #ddd; text-align: left; }
        th, td { padding: 10px; }
        th { background-color: #d9e1f2; }
        .btn { padding: 6px 12px; text-decoration: none; color: white; border-radius: 4px; font-size: 14px; border: none; cursor: pointer; }
        .btn-tambah { background-color: #5cb85c; float: right; margin-bottom: 10px; }
        .btn-edit { background-color: #f0ad4e; margin-right: 5px; }
        .btn-hapus { background-color: #d9534f; }
    </style>
</head>
<body>

    <h2>Data Master Supplier</h2>
    <a href="tambah.php" class="btn btn-tambah">Tambah Data</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id DESC");
        while($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($data['nama']); ?></td>
            <td><?= htmlspecialchars($data['telp']); ?></td>
            <td><?= htmlspecialchars($data['alamat']); ?></td>
            <td>
                <a href="edit.php?id=<?= $data['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="hapus.php?id=<?= $data['id']; ?>" class="btn btn-hapus" onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>