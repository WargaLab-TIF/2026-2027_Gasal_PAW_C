<?php
include 'koneksi.php';

$hapus = false;

if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM supplier WHERE id = $id");
    $hapus = true;
}

$data = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Master Supplier</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f2f2f2;
        }

        h2 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        th {
            background-color: blue;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            text-align: left;
            border: 1px solid black;
        }

        td {
            font-size: 16px;
            padding: 10px;
            border: 1px solid black;
            color: black;
        }

        .tombol {
            display: inline-block;
            padding: 8px 14px;
            background-color: blue;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .tombol-edit {
            background-color: orange;
            padding: 6px 12px;
            margin-bottom: 0;
        }

        .tombol-hapus {
            background-color: red;
            padding: 6px 12px;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <h2>Data Master Supplier</h2>

    <?php if ($hapus) { ?>
        <p style="color: green;">Data supplier berhasil dihapus.</p>
    <?php } ?>

    <?php if (isset($_GET['status'])) { ?>
        <?php if ($_GET['status'] == "tambah") { ?>
            <p style="color: green;">Data supplier berhasil ditambahkan.</p>
        <?php } elseif ($_GET['status'] == "edit") { ?>
            <p style="color: green;">Data supplier berhasil diperbarui.</p>
        <?php } ?>
    <?php } ?>

    <a href="tambah.php" class="tombol">Tambah Data</a>

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
        while ($row = mysqli_fetch_assoc($data)) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['telp']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="tombol tombol-edit">Edit</a>
                    <a href="index.php?hapus=<?= $row['id'] ?>" class="tombol tombol-hapus" onclick="return confirm('Anda yakin akan menghapus supplier ini?');">Hapus</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
