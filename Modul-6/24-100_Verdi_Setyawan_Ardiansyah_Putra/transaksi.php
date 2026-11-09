<?php
include "koneksi.php";

if (isset($_POST['simpan_transaksi'])) {
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $pelanggan_id = mysqli_real_escape_string($koneksi, $_POST['pelanggan_id']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
    VALUES ('$tanggal', '$keterangan', 0, '$pelanggan_id')";
    mysqli_query($koneksi, $query);

    $id_baru = mysqli_insert_id($koneksi);
    header("Location: transaksi.php?id=$id_baru&pesan=Transaksi berhasil ditambahkan");
    exit;
}

if (isset($_POST['simpan_detail'])) {
    $transaksi_id = (int) $_POST['transaksi_id'];
    $barang_id = (int) $_POST['barang_id'];
    $qty = (int) $_POST['qty'];

    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail
    WHERE transaksi_id = $transaksi_id
    AND barang_id = $barang_id");

    if (mysqli_num_rows($cek) > 0) {
        header("Location: transaksi.php?id=$transaksi_id&pesan=Barang sudah ada di transaksi ini");
        exit;
    }

    $query_barang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id = $barang_id");
    $barang = mysqli_fetch_assoc($query_barang);

    if ($barang && $qty > 0) {
        $harga = (int) $barang['harga'];

        mysqli_query($koneksi, "INSERT INTO transaksi_detail
            (transaksi_id, barang_id, harga, qty)
            VALUES ($transaksi_id, $barang_id, $harga, $qty)");

        mysqli_query($koneksi, "UPDATE transaksi SET total = (
            SELECT IFNULL(SUM(harga * qty), 0)
            FROM transaksi_detail
            WHERE transaksi_id = $transaksi_id
        ) WHERE id = $transaksi_id");

        header("Location: transaksi.php?id=$transaksi_id&pesan=Detail transaksi berhasil ditambahkan");
        exit;
    } else {
        header("Location: transaksi.php?id=$transaksi_id&pesan=Data barang atau jumlah tidak valid");
        exit;
    }
}

$id_transaksi = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id_transaksi == 0) {
    $transaksi_pertama = mysqli_query($koneksi, "SELECT id FROM transaksi ORDER BY id ASC LIMIT 1");
    $data_pertama = mysqli_fetch_assoc($transaksi_pertama);

    if ($data_pertama) {
        $id_transaksi = (int) $data_pertama['id'];
    }
}

$query_transaksi = mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama AS nama_pelanggan
    FROM transaksi
    JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
    ORDER BY transaksi.id ASC");

$query_master = mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama AS nama_pelanggan
    FROM transaksi
    JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
    WHERE transaksi.id = $id_transaksi");
$data_master = mysqli_fetch_assoc($query_master);

$query_detail = mysqli_query($koneksi, "SELECT transaksi_detail.*, barang.kode_barang,
    barang.nama_barang, (transaksi_detail.harga * transaksi_detail.qty) AS subtotal
    FROM transaksi_detail
    JOIN barang ON transaksi_detail.barang_id = barang.id
    WHERE transaksi_detail.transaksi_id = $id_transaksi");

$query_barang = mysqli_query($koneksi, "SELECT * FROM barang
    WHERE id NOT IN (
        SELECT barang_id FROM transaksi_detail
        WHERE transaksi_id = $id_transaksi
    )");

$query_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Aplikasi Penjualan</h1>

    <nav>
        <a href="transaksi.php">Transaksi</a>
        <a href="barang.php">Data Barang</a>
    </nav>

    <?php if (isset($_GET['pesan'])) { ?>
        <p class="pesan"><?php echo htmlspecialchars($_GET['pesan']); ?></p>
    <?php } ?>

    <h2>Data Transaksi (Master)</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
        <?php while ($transaksi = mysqli_fetch_assoc($query_transaksi)) { ?>
        <tr>
            <td><?php echo $transaksi['id']; ?></td>
            <td><?php echo htmlspecialchars($transaksi['waktu_transaksi']); ?></td>
            <td><?php echo htmlspecialchars($transaksi['nama_pelanggan']); ?></td>
            <td><?php echo htmlspecialchars($transaksi['keterangan']); ?></td>
            <td>Rp <?php echo number_format($transaksi['total'], 0, ',', '.'); ?></td>
            <td><a href="transaksi.php?id=<?php echo $transaksi['id']; ?>">Pilih</a></td>
        </tr>
        <?php } ?>
    </table>

    <div class="dua-kolom">
        <section>
            <h2>Tambah Transaksi</h2>
            <form method="POST">
                <label>Tanggal transaksi</label>
                <input type="date" name="tanggal" required>

                <label>Pelanggan</label>
                <select name="pelanggan_id" required>
                    <option value="">-- Pilih pelanggan --</option>
                    <?php while ($pelanggan = mysqli_fetch_assoc($query_pelanggan)) { ?>
                        <option value="<?php echo htmlspecialchars($pelanggan['id']); ?>">
                            <?php echo htmlspecialchars($pelanggan['nama']); ?>
                        </option>
                    <?php } ?>
                </select>

                <label>Keterangan</label>
                <textarea name="keterangan"></textarea>
                <button type="submit" name="simpan_transaksi">Simpan Transaksi</button>
            </form>
        </section>

        <section>
            <h2>Detail Transaksi</h2>
            <?php if ($data_master) { ?>
                <p><b>Transaksi:</b> <?php echo $data_master['id']; ?></p>
                <p><b>Pelanggan:</b> <?php echo htmlspecialchars($data_master['nama_pelanggan']); ?></p>
                <p><b>Total:</b> Rp <?php echo number_format($data_master['total'], 0, ',', '.'); ?></p>

                <table>
                    <tr>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                    <?php while ($detail = mysqli_fetch_assoc($query_detail)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['nama_barang']); ?></td>
                        <td>Rp <?php echo number_format($detail['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $detail['qty']; ?></td>
                        <td>Rp <?php echo number_format($detail['subtotal'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php } ?>
                </table>

                <h3>Tambah Detail Barang</h3>
                <form method="POST">
                    <input type="hidden" name="transaksi_id" value="<?php echo $data_master['id']; ?>">

                    <label>Barang</label>
                    <select name="barang_id" required>
                        <option value="">-- Pilih barang --</option>
                        <?php while ($barang = mysqli_fetch_assoc($query_barang)) { ?>
                            <option value="<?php echo $barang['id']; ?>">
                                <?php echo htmlspecialchars($barang['nama_barang']); ?> - Rp <?php echo number_format($barang['harga'], 0, ',', '.'); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <label>Jumlah (Qty)</label>
                    <input type="number" name="qty" min="1" value="1" required>
                    <button type="submit" name="simpan_detail">Simpan Detail</button>
                </form>
                <p class="catatan">Barang yang sudah dimasukkan tidak ditampilkan lagi pada pilihan barang transaksi ini.</p>
            <?php } else { ?>
                <p>Belum ada transaksi. Silakan tambahkan transaksi terlebih dahulu.</p>
            <?php } ?>
        </section>
    </div>
</div>
</body>
</html>