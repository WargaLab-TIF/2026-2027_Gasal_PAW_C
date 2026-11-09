<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Daftar Barang</h2>
        
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200 border-b">
                    <th class="p-2">No</th>
                    <th class="p-2">Kode</th>
                    <th class="p-2">Nama Barang</th>
                    <th class="p-2">Harga</th>
                    <th class="p-2">Stok</th>
                    <th class="p-2">Supplier</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($conn, "SELECT barang.*, supplier.nama AS nama_supplier 
                                              FROM barang 
                                              LEFT JOIN supplier ON barang.supplier_id = supplier.id");
                
                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2"><?php echo $no++; ?></td>
                    <td class="p-2"><?php echo $row['kode_barang']; ?></td>
                    <td class="p-2"><?php echo $row['nama_barang']; ?></td>
                    <td class="p-2">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td class="p-2"><?php echo $row['stok']; ?></td>
                    <td class="p-2"><?php echo $row['nama_supplier']; ?></td>
                    <td class="p-2">
                        <a href="hapus_barang.php?id=<?php echo $row['id']; ?>" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');" 
                           class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="mt-6">
            <a href="tambah_transaksi.php" class="text-blue-600 underline hover:text-blue-800">Buka Halaman Input Transaksi</a>
        </div>
    </div>
</body>
</html>