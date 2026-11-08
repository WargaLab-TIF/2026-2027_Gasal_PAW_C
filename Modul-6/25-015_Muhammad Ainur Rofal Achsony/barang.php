<?php
require "koneksi.php";

$status = isset($_GET["status"]) ? $_GET["status"] : "";

$dataBarang = mysqli_query($conn, "SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama AS nama_supplier
                                   FROM barang b
                                   JOIN supplier s ON s.id = b.supplier_id
                                   ORDER BY b.id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f9;
            color: #222;
            margin: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        h1,
        h2 {
            color: #1565c0;
        }

        nav {
            margin-bottom: 15px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            background: #fff;
        }

        th,
        td {
            border: 1px solid #cfd8dc;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #e3f2fd;
        }

        tr.aktif td {
            background: #fff8e1;
        }

        table.info {
            width: 60%;
        }

        table.info th {
            width: 30%;
        }

        .btn {
            display: inline-block;
            padding: 6px 10px;
            background: #1565c0;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background: #0d47a1;
        }

        .btn-hapus {
            background: #c62828;
        }

        .btn-hapus:hover {
            background: #8e0000;
        }

        .pesan {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }

        .sukses {
            background: #e8f5e9;
            color: #1b5e20;
            border: 1px solid #a5d6a7;
        }

        .error {
            background: #ffebee;
            color: #b71c1c;
            border: 1px solid #ef9a9a;
        }

        form {
            background: #fff;
            border: 1px solid #cfd8dc;
            padding: 12px;
            margin-bottom: 15px;
        }

        label {
            margin-right: 6px;
        }

        input,
        select {
            padding: 6px;
            margin-right: 12px;
        }

        .selesai {
            color: #666;
        }
    </style>
</head>
<body>
<div class="container">
    <nav>
        <a class="btn" href="index.php">Data Transaksi</a>
        <a class="btn" href="barang.php">Data Barang</a>
    </nav>

    <h1>Data Barang</h1>

    <?php if ($status == "hapus") : ?>
        <p class="pesan sukses">Data barang berhasil dihapus.</p>
    <?php endif; ?>

    <?php if ($status == "dipakai") : ?>
        <p class="pesan error">Barang tidak dapat dihapus karena masih digunakan pada transaksi.</p>
    <?php endif; ?>

    <table>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($barang = mysqli_fetch_assoc($dataBarang)) :
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= htmlspecialchars($barang["kode_barang"]) ?></td>
                <td><?= htmlspecialchars($barang["nama_barang"]) ?></td>
                <td>Rp <?= number_format($barang["harga"], 0, ",", ".") ?></td>
                <td><?= $barang["stok"] ?></td>
                <td><?= htmlspecialchars($barang["nama_supplier"]) ?></td>
                <td>
                    <a class="btn btn-hapus"
                       href="hapus_barang.php?id=<?= $barang["id"] ?>"
                       onclick="return confirm('Hapus barang ini?')">Hapus</a>
                </td>
            </tr>
        <?php
            $no++;
        endwhile;
        ?>
    </table>
</div>
</body>
</html>
