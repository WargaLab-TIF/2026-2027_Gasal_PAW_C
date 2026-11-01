<?php
include "koneksi.php";

$data = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        .head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        h1,
        h2 {
            color: #2e7d7a;
            font-size: 24px;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th,
        td {
            padding: 10px;
            border: 1px solid #eee;
        }
        th {
            background: #d6eef8;
            color: #333;
            text-align: left;
            font-weight: normal;
        }
        .btn {
            display: inline-block;
            padding: 6px 14px;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-green {
            background: #7cb342;
        }
        .btn-orange {
            background: #e65100;
        }
        .btn-red {
            background: #b71c1c;
        }
        .alert {
            margin-bottom: 15px;
            padding: 10px;
            background: #fdeaea;
            color: #b71c1c;
        }
        label {
            display: inline-block;
            width: 80px;
            vertical-align: top;
        }
        input,
        textarea {
            width: 300px;
            padding: 6px;
            margin-bottom: 10px;
        }
        .form-actions {
            margin-left: 84px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="head">
        <h2>Data Master Supplier</h2>
        <a class="btn btn-green" href="tambah_supplier.php">Tambah Data</a>
    </div>

    <table class="data">
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
            <td><?php echo $no; ?></td>
            <td><?php echo htmlspecialchars($row["nama"]); ?></td>
            <td><?php echo htmlspecialchars($row["telp"]); ?></td>
            <td><?php echo htmlspecialchars($row["alamat"]); ?></td>
            <td class="actions">
                <a class="btn btn-orange" href="edit_supplier.php?id=<?php echo $row["id"]; ?>">Edit</a>
                <a class="btn btn-red" href="hapus_supplier.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Anda yakin akan menghapus supplier ini?');">Hapus</a>
            </td>
        </tr>
        <?php
            $no++;
        }
        ?>
    </table>
</div>
</body>
</html>
