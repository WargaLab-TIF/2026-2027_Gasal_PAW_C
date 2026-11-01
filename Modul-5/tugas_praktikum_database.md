# MODULE 5: DATABASE
## Tugas Praktikum

**1. Membuat skema database seperti berikut ini**

**Skema Relasi Tabel:**
*   **transaksi_detail**: `transaksi_id` int(11), `barang_id` int(11), `harga` int(11), `qty` int(11)
*   **transaksi**: `id` int(11), `waktu_transaksi` date, `keterangan` text, `total` int(11), `pelanggan_id` varchar(20)
*   **pelanggan**: `id` varchar(20), `nama` varchar(100), `jenis_kelamin` enum('L', 'P'), `telp` varchar(12), `alamat` text
*   **barang**: `id` int(11), `kode_barang` varchar(10), `nama_barang` varchar(100), `harga` int(11), `stok` int(11), `supplier_id` int(11)
*   **supplier**: `id` int(11), `nama` varchar(100), `telp` varchar(12), `alamat` text
*   **pembayaran**: `id` int(11), `waktu_bayar` datetime, `total` int(11), `metode` enum('TUNAI', 'TRANSFER', 'EDC'), `transaksi_id` int(11)
*   **user**: `id_user` tinyint(2), `username` varchar(30), `password` varchar(35), `nama` varchar(50), `alamat` varchar(150), `hp` varchar(20), `level` tinyint(1)

**Deskripsi database:**

| Tabel | Kolom | Atribut | Deskripsi |
| :--- | :--- | :--- | :--- |
| **pelanggan** | id | primary key, not null | mencatat kode pelanggan |
| | nama | | mencatat nama pelanggan |
| | jenis_kelamin | | mencatat jenis kelamin dengan isian L atau P |
| | telp | | mencatat no telepon pelanggan |
| | alamat | | mencatat alamat pelanggan |
| **transaksi** | id | primary key, auto increment, not null | mencatat kode transaksi |
| | waktu_transaksi | | mencatat waktu terjadinya transaksi |
| | keterangan | | mencatat informasi atau catatan transaksi |
| | total | | mencatat keseluruhan harga transaksi |
| | pelanggan_id | | foreign key dari id pada table pelanggan yang digunakan untuk memilih id dari table pelanggan |
| **transaksi_detail** | transaksi_id | composite primary key, not null | foreign key dari id pada table transaksi yang di sini menjadi (composite) primary key pada table transaksi_detail |
| | barang_id | composite primary key, not null | foreign key dari id pada table barang yang disini menjadi (composite) primary key pada table transaksi_detail |
| | harga | | mencatat harga jual barang |
| | qty | | mencatat jumlah barang dijual |
| **barang** | id | primary key, auto increment, not null | mencatat id barang |
| | kode_barang | | mencatat kode barang |
| | nama_barang | | mencatat nama barang |
| | harga | | mencatat harga barang |
| | stok | | mencatat stok barang |
| | supplier_id | | foreign key dari id pada table supplier yang digunakan untuk memilih id dari table supplier |
| **supplier** | id | primary key, auto increment, not null | mencatat kode supplier |
| | nama | | mencatat nama supplier |
| | telp | | mencatat telp supplier |
| | alamat | | mencatat alamat supplier |
| **user** | id_user | primary key, auto increment, not null | mencatat id user |
| | username | | mencatat username |
| | password | | mencatat password user |
| | nama | | mencatat nama user |
| | alamat | | mencatat alamat user |
| | hp | | mencatat hp user |
| | level | | mencatat level akses user |
| **pembayaran** | id | primary key, auto increment, not null | mencatat id pembayaran |
| | waktu_bayar | | mencatat waktu pembayaran |
| | total | | mencatat total pembayaran |
| | metode | | mencatat metode pembayaran Tunai, transfer atau EDC |
| | transaksi_id | | foreign key dari id pada table transaksi yang digunakan untuk memilih id dari table transaksi |

---

**2. Mengisi data master dan data transaksi yang ada minimal 10 data setiap tablenya**

**3. Membuat tampilan dan mengambil data dari database di atas**

### Data Master Supplier
`[ Tambah Data ]`

| No | Nama | Telp | Alamat | Tindakan |
| :---: | :--- | :--- | :--- | :---: |
| 1 | PT. Maju Bersama | 08123456 | Surabaya | `[ Edit ]` `[ Hapus ]` |
| 2 | PT. Senang Sekali | 081515563 | Bangkalan | `[ Edit ]` `[ Hapus ]` |
| 3 | PT Segar Segar | 0845454663 | Surabaya | `[ Edit ]` `[ Hapus ]` |

---

**4. Membuat halaman tambah data baru saat ditekan tomboh tambah data**

### Tambah Data Master Supplier Baru
*   **Nama:** `[ Input: Nama ]`
*   **Telp:** `[ Input: telp ]`
*   **Alamat:** `[ Input: alamat ]`

`[ Simpan ]` `[ Batal ]`

---

**5. Membuat halaman edit data yang ada saat ditekan tombol edit**

### Edit Data Master Supplier
*   **Nama:** `[ Input: PT. Maju Bersama ]`
*   **Telp:** `[ Input: 08123456 ]`
*   **Alamat:** `[ Input: Surabaya ]`

`[ Update ]` `[ Batal ]`

---

**6. Membuat popup windows seperti dibawah ini saat ditekan tombol hapus. Dan data yang dimaksud akan terhapus**

> **localhost says**
> 
> Anda yakin akan menghapus supplier ini?
> 
> `[ OK ]` `[ Cancel ]`

---

### Referensi
1. Chris Bates [2006]. Web Programming: Building Internet Applications, Third Edition, John Wiley & Sons Ltd, England.
2. Sebesta, R.W. [2002], Programming the World Wide Web, Addison Wesley.
3. http://www.w3schools.com