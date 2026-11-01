<?php
require 'koneksi.php';

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM supplier ORDER BY id DESC"
);

if (!$data) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>
</head>

<body>

<h2>Data Master Supplier</h2>

<a href="tambah.php">Tambah Data</a>

<br><br>

<table border="1" cellpadding="8" cellspacing="0">
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
        <?php
        $no = 1;

        while ($row = mysqli_fetch_assoc($data)) {
        ?>
        <tr>
            <td><?= $no++ ?></td>

            <td>
                <?= htmlspecialchars($row['nama']) ?>
            </td>

            <td>
                <?= htmlspecialchars($row['telp'] ?? '') ?>
            </td>

            <td>
                <?= htmlspecialchars($row['alamat'] ?? '') ?>
            </td>

            <td>
                <a href="edit.php?id=<?= (int)$row['id'] ?>">
                    Edit
                </a>
                <a href="hapus.php?id=<?= (int)$row['id'] ?>"
                   onclick="return confirm('Anda yakin akan menghapus supplier ini?')">
                    Hapus
                </a>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>

</body>
</html>
