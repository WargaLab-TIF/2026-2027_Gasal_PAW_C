<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Histori Transaksi</h2>
        
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200 border-b">
                    <th class="p-2">ID Transaksi</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Pelanggan</th>
                    <th class="p-2">Keterangan</th>
                    <th class="p-2">Total Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT transaksi.*, pelanggan.nama AS nama_pelanggan 
                                              FROM transaksi 
                                              LEFT JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
                                              ORDER BY transaksi.id DESC");
                
                if (mysqli_num_rows($query) == 0) {
                    echo "<tr><td colspan='5' class='p-4 text-center text-gray-500'>Belum ada transaksi.</td></tr>";
                }

                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">#<?php echo $row['id']; ?></td>
                    <td class="p-2"><?php echo date('d-m-Y', strtotime($row['waktu_transaksi'])); ?></td>
                    <td class="p-2"><?php echo $row['nama_pelanggan']; ?></td>
                    <td class="p-2"><?php echo $row['keterangan']; ?></td>
                    <td class="p-2 font-bold text-green-600">Rp <?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="mt-6 flex gap-4">
            <a href="tambah_transaksi.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Input Transaksi Baru</a>
            <a href="data_barang.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kelola Data Barang</a>
        </div>
    </div>
</body>
</html>