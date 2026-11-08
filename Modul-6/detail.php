<?php
include 'koneksi.php';

$id = $_GET['id'];
$ambil_transaksi = mysqli_query($conn, "SELECT transaksi.*, pelanggan.nama FROM transaksi LEFT JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id WHERE transaksi.id = '$id'");
$transaksi = mysqli_fetch_array($ambil_transaksi);
$cek_barang = mysqli_query($conn, "SELECT barang_id FROM transaksi_detail WHERE transaksi_id = '$id'");
$ada = array();
while ($c = mysqli_fetch_array($cek_barang)) {
    $ada[] = $c['barang_id'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
</head>
<body>
    <p><a href="index.php">Kembali</a></p>
<h2>Detail Transaksi</h2>
<p>
    <label>ID Transaksi:</label>
    <?php echo $transaksi['id']; ?>
</p>
<p>
    <label>Tanggal:</label>
    <?php echo $transaksi['waktu_transaksi']; ?>
</p>
<p>
    <label>Pelanggan:</label>
    <?php echo $transaksi['nama']; ?>
</p>
<p>
    <label>Total:</label>
    Rp <?php echo $transaksi['total']; ?>
</p>
<hr>
<h3>Barang yang Dibeli</h3>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $no = 1;
        $sql_detail = mysqli_query($conn, "SELECT transaksi_detail.*, barang.nama_barang FROM transaksi_detail JOIN barang ON transaksi_detail.barang_id = barang.id WHERE transaksi_detail.transaksi_id = '$id'");
        while ($row = mysqli_fetch_array($sql_detail)) {
            $sub = $row['harga'] * $row['qty'];
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td>Rp <?php echo $row['harga']; ?></td>
            <td><?php echo $row['qty']; ?></td>
            <td>Rp <?php echo $sub; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <br>
    <h3>Tambah Barang</h3>
    <form action="detail_tambah.php" method="POST">
        <input type="hidden" name="transaksi_id" value="<?php echo $id; ?>">
        <label>Pilih Barang:</label>
        <select name="barang_id" required>
            <option value="">pilih Barang</option>
            <?php
            $sql_barang= mysqli_query($conn, "SELECT * FROM barang");
            while ($barang = mysqli_fetch_array($sql_barang)) {
                $disable = in_array($barang['id'], $ada) ? 'disabled' : '';
                echo "<option value='".$barang['id']."' ".$disable.">".$barang['nama_barang']." - Rp ".$barang['harga']."</option>";
            }
            ?>
        </select>
        <label>Jumlah:</label>
        <input type="number" name="qty" value="1" min="1" required>
        <input type="submit" value="Tambah">
    </form>
</body>
</html>