# Modul 5 - Database

**Nama:** Rizky Ahmad Nasrulloh
**NIM:** 25-022
**Mata Kuliah:** Praktikum Pengembangan Aplikasi Web C

Modul 5 membahas pembuatan skema database relasional, pengisian data master
dan data transaksi, serta pembuatan tampilan CRUD (Create, Read, Update,
Delete) untuk Data Master Supplier dengan PHP dan MySQL.

---

## Struktur Folder

```
Modul-5/
├── README.md
├── tugas_praktikum_database.md
└── 25-022_Rizky Ahmad Nasrulloh/
    ├── database/
    │   └── tp5_praktikum.sql
    └── index.php
```

---

## Skema Database

Nama database: `tp5_praktikum`, 7 tabel InnoDB dengan relasi antar tabel.

| Tabel | Primary Key | Kolom Penting |
|---|---|---|
| `supplier` | `id` (auto increment) | `nama`, `telp`, `alamat` |
| `pelanggan` | `id` varchar(20) | `nama`, `jenis_kelamin` (L/P), `telp`, `alamat` |
| `user` | `id_user` (auto increment) | `username`, `password`, `nama`, `alamat`, `hp`, `level` |
| `barang` | `id` (auto increment) | `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id` |
| `transaksi` | `id` (auto increment) | `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id` |
| `transaksi_detail` | `(transaksi_id, barang_id)` composite | `harga`, `qty` |
| `pembayaran` | `id` (auto increment) | `waktu_bayar`, `total`, `metode` (TUNAI/TRANSFER/EDC), `transaksi_id` |

Relasi (foreign key):

- `barang.supplier_id` -> `supplier.id` (ON DELETE SET NULL)
- `transaksi.pelanggan_id` -> `pelanggan.id`
- `transaksi_detail.transaksi_id` -> `transaksi.id` (ON DELETE CASCADE)
- `transaksi_detail.barang_id` -> `barang.id`
- `pembayaran.transaksi_id` -> `transaksi.id` (ON DELETE CASCADE)

`transaksi_detail` memakai primary key gabungan `(transaksi_id, barang_id)`
sesuai modul, sehingga satu barang hanya muncul sekali per transaksi.

### Data Contoh

File `database/tp5_praktikum.sql` mengisi 10 baris untuk setiap tabel:

- 10 supplier dan 10 pelanggan
- 10 user (`admin` level 1, `kasir1`-`kasir9` level 2, password `admin123`/`kasir123` dalam md5)
- 10 barang, masing-masing terhubung ke satu supplier
- 10 transaksi, 21 baris transaksi_detail, dan 10 pembayaran
- Nilai `transaksi.total` sudah dicocokkan dengan `SUM(harga * qty)` pada detail
  dan dengan `pembayaran.total`

---

## Aplikasi Data Master Supplier

Seluruh logika aplikasi berada dalam satu file `index.php`: konfigurasi
koneksi, router, proses CRUD, dan tampilan (HTML + CSS).

### Routing

| URL | Aksi |
|---|---|
| `index.php` | Menampilkan daftar supplier |
| `index.php?action=tambah` | Form tambah data |
| `index.php?action=edit&id=1` | Form edit data |
| `index.php?action=hapus&id=1` | Menghapus data |

Router memakai `switch ($_GET['action'] ?? 'list')`, lalu satu blok HTML di
bagian bawah menampilkan halaman sesuai `$action`.

### Alur CRUD

1. **Read** - `index.php` menjalankan `SELECT id, nama, telp, alamat FROM supplier ORDER BY id`
   dan menampilkannya pada tabel No/Nama/Telp/Alamat/Tindakan.
2. **Create** - form tambah mengirim data dengan `method="post"`, divalidasi,
   lalu disimpan dengan `INSERT INTO supplier`.
3. **Update** - form edit mengambil data lama lewat `id`, menampilkan nilai yang
   sudah terisi (sticky form), lalu menyimpan dengan `UPDATE`.
4. **Delete** - tombol Hapus memanggil `confirm('Anda yakin akan menghapus supplier ini?')`
   sehingga muncul dialog "localhost says ..." seperti pada modul, lalu
   menjalankan `DELETE FROM supplier WHERE id = ?`.

   Relasi `barang.supplier_id` memakai `ON DELETE SET NULL`, jadi supplier
   yang masih dipakai barang tetap bisa dihapus: baris supplier hilang dan
   `supplier_id` pada barang terkait otomatis menjadi `NULL`. Bila ada
   constraint lain yang menolak penghapusan, error ditangkap dan ditampilkan
   sebagai pesan "Data supplier gagal dihapus karena masih dipakai data lain."
   (bukan fatal error PHP).

### Validasi

| Field | Aturan |
|---|---|
| Nama | wajib diisi, 3-100 karakter |
| Telp | wajib diisi, hanya angka, 6-12 digit |
| Alamat | opsional |

Jika validasi gagal, form ditampilkan kembali lengkap dengan pesan error di
bawah field yang bermasalah dan nilai yang sudah diketik tetap ada.

### Keamanan

- Semua query memakai **prepared statement** (`prepare` + `bind_param`) agar
  aman dari SQL injection.
- Semua output di-escape dengan `htmlspecialchars()` melalui helper `e()`
  agar aman dari XSS.
- Setelah proses simpan/hapus, halaman di-redirect (POST -> Redirect -> GET)
  supaya refresh browser tidak mengirim ulang data.

### Notifikasi

Setelah aksi berhasil, halaman daftar menampilkan banner status dari parameter
`?status=tambah|edit|hapus`, dan `?status=tidakada` bila `id` yang dibuka tidak
ditemukan.

---

## Cara Menjalankan

1. Jalankan **Apache** dan **MySQL** dari XAMPP Control Panel.
2. Buka `http://localhost/phpmyadmin`, pilih tab **Import**, lalu pilih file
   `database/tp5_praktikum.sql` dan klik **Go**.
   (Alternatif lewat terminal: `mysql -u root < database/tp5_praktikum.sql`.)
3. Buka aplikasinya:

   `http://localhost/2026-2027_Gasal_PAW_C/Modul-5/25-022_Rizky%20Ahmad%20Nasrulloh/index.php`

4. Uji tombol **Tambah Data**, **Edit**, dan **Hapus**.

Konfigurasi koneksi ada di bagian atas `index.php`:

```php
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'tp5_praktikum';
```

Sesuaikan `DB_USER` dan `DB_PASS` bila MySQL di komputermu memakai password.
