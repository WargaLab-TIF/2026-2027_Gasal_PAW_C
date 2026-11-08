<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Master Barang</title></head>
<body>
    <h2>Data Barang</h2>
    <a href="index.php">Kembali ke Master Transaksi</a><br><br>
    
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = "SELECT * FROM barang";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['kode_barang']}</td>
                    <td>{$row['nama_barang']}</td>
                    <td>Rp " . number_format($row['harga'],0,',','.') . "</td>
                    <td>{$row['stok']}</td>
                    <td>
                        <a href='hapus_barang.php?id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus barang ini?');\">Hapus</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>