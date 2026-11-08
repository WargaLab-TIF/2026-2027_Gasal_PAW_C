<?php
include 'koneksi.php';

$id_transaksi = $_GET['id'];

$sql_transaksi = mysqli_query($conn, "SELECT transaksi.*, pelanggan.nama FROM transaksi LEFT JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id WHERE transaksi.id = '$id_transaksi'");
$data= mysqli_fetch_array($sql_transaksi);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
</head>
<body>

    <p><a href="index.php">Kembali</a></p>

    <h2>Detail Transaksi</h2>
    <p>ID Transaksi: <?php echo $data['id']; ?></p>
    <p>Tanggal: <?php echo $data['waktu_transaksi']; ?></p>
    <p>Pelanggan: <?php echo $data['nama']; ?></p>
    <p>Total: Rp <?php echo $data['total']; ?></p>

    <hr>

    <h3>Barang yang Dibeli</h3>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $nomor = 1;
        $sql_detail = mysqli_query($conn, "SELECT transaksi_detail.*, barang.nama_barang FROM transaksi_detail JOIN barang ON transaksi_detail.barang_id = barang.id WHERE transaksi_detail.transaksi_id = '$id_transaksi'");

        while ($row = mysqli_fetch_array($sql_detail)) {
            $subtotal = $row['harga'] * $row['qty'];
        ?>
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td>Rp <?php echo $row['harga']; ?></td>
            <td><?php echo $row['qty']; ?></td>
            <td>Rp <?php echo $subtotal; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <br>
    <h3>Tambah Barang</h3>
    <form action="detail_tambah.php" method="POST">
        <input type="hidden" name="transaksi_id" value="<?php echo $id_transaksi; ?>">
        <label>Pilih Barang:</label>
        <select name="barang_id" required>
            <option value="">pilih barang</option>
            <?php
            $sql_barang = mysqli_query($conn, "SELECT * FROM barang");
            while ($barang = mysqli_fetch_array($sql_barang)) {
                $id_brg = $barang['id'];

                $cek_ada = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id = '$id_transaksi' AND barang_id = '$id_brg'");
                
                if (mysqli_num_rows($cek_ada) > 0) {
                    echo "<option value='".$barang['id']."' disabled>".$barang['nama_barang']." - Rp ".$barang['harga']."</option>";
                } else {
                    echo "<option value='".$barang['id']."'>".$barang['nama_barang']." - Rp ".$barang['harga']."</option>";
                }
            }
            ?>
        </select>
        <label>Qty:</label>
        <input type="number" name="qty" value="1" min="1" required>
        <input type="submit" value="Tambah">
    </form>
</body>
</html>