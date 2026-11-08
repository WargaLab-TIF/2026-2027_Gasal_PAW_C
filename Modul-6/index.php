<?php
include 'koneksi.php';

$sql = mysqli_query($conn, "SELECT transaksi.*, pelanggan.nama AS nama_pelanggan FROM transaksi LEFT JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Transaksi</title>
</head>
<body> 
    <h2>Data Transaksi</h2>
    <a href="data_barang.php">Data Barang</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($data = mysqli_fetch_assoc($sql)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['waktu_transaksi']; ?></td>
            <td><?php echo $data['nama_pelanggan']; ?></td>
            <td>Rp <?php echo $data['total']; ?></td>
            <td>
                <a href="detail.php?id=<?php echo $data['id']; ?>">detail</a> |
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>