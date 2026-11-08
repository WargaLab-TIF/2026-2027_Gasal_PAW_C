# Modul 6 — Pengelolaan Master Detil Data

Praktikum Pengembangan Aplikasi Web C.

| | |
|---|---|
| **Nama** | Rizky Ahmad Nasrulloh |
| **NIM** | 25-022 |
| **Mata Kuliah** | Praktikum Pengembangan Aplikasi Web C |
| **Modul** | 6 — Pengelolaan Master Detil Data |
| **Sub CPMK** | Implementasi form web master detil |

Aplikasi web PHP + MySQL untuk mengelola data **transaksi** (master) beserta
**detail barang** (detail), lengkap dengan pengelolaan data barang.

---

## Fitur

1. **Database & relasi** — 7 tabel (`supplier`, `pelanggan`, `barang`,
   `transaksi`, `transaksi_detail`, `pembayaran`, `user`) dengan Foreign Key.
   Data master minimal 5 baris, data transaksi 10 baris.
2. **Halaman master-detail transaksi** (`index.php`)
   - Memilih transaksi (master) lalu menampilkan detail barangnya.
   - Dropdown barang diambil dari tabel `barang`.
   - Barang yang **sudah masuk** ke transaksi tersebut otomatis **disembunyikan**
     dari dropdown, sehingga tidak bisa diinput dua kali.
3. **Hapus barang dengan pengecekan** (`barang.php`)
   - Menolak hapus + menampilkan notifikasi jika barang masih dipakai di
     `transaksi_detail`.
   - Mengizinkan hapus jika barang belum pernah dipakai.
4. **Total transaksi otomatis** — setiap detail baru disimpan, kolom
   `transaksi.total` dihitung ulang dari `SUM(harga * qty)` seluruh detail
   transaksi tersebut.

---

## Struktur Folder

```
Modul-6/
├── README.md
└── 25-022_Rizky Ahmad Nasrulloh/
    ├── index.php                              # Master-detail transaksi
    ├── barang.php                             # Daftar + hapus barang
    ├── koneksi.php                            # Koneksi DB + helper
    ├── style.css                              # CSS bersama
    ├── database/
    │   └── tp6_praktikum.sql                  # Skema + seed data
    └── modul_6_pengelolaan_master_detil_data.md
```

---

## Skema Relasi Database

```
supplier (1) ──< barang (1) ──< transaksi_detail >── (1) transaksi
pelanggan (1) ──< transaksi (1) ──< pembayaran
user
```

| Tabel | Keterangan |
|---|---|
| `supplier` | Master supplier |
| `pelanggan` | Master pelanggan |
| `barang` | Master barang (`supplier_id` FK ke `supplier.id`) |
| `transaksi` | Master transaksi (`pelanggan_id` FK ke `pelanggan.id`) |
| `transaksi_detail` | Detail transaksi (FK ke `transaksi.id` & `barang.id`, PK komposit) |
| `pembayaran` | Pembayaran (FK ke `transaksi.id`) |
| `user` | Data pengguna |

---

## Cara Menjalankan

1. **Jalankan XAMPP** — aktifkan **Apache** dan **MySQL**.
2. **Impor database** melalui phpMyAdmin:
   - Buka `http://localhost/phpmyadmin`
   - Menu **Import** → pilih file `database/tp6_praktikum.sql` → **Go**
   - Atau lewat terminal:
     ```bash
     mysql -u root < database/tp6_praktikum.sql
     ```
3. **Buka aplikasi** di browser:
   ```
   http://localhost/2026-2027_Gasal_PAW_C/Modul-6/25-022_Rizky%20Ahmad%20Nasrulloh/index.php
   ```

Konfigurasi database ada di `koneksi.php` (default: host `localhost`,
user `root`, password kosong, database `tp6_praktikum`).

---

## Cara Pakai

**Halaman Transaksi (`index.php`)**
1. Pilih transaksi dari dropdown lalu klik **Load**.
2. Data master dan tabel detail akan tampil.
3. Pilih barang + isi **Qty**, klik **Simpan** untuk menambah detail.
4. `total` transaksi otomatis diperbarui.
5. Barang yang sudah ada di transaksi tidak muncul lagi di dropdown.

**Halaman Data Barang (`barang.php`)**
1. Tabel berisi daftar barang beserta supplier.
2. Klik **Hapus**:
   - Berhasil bila barang belum dipakai.
   - Ditolak + notifikasi bila barang masih dipakai pada transaksi.

---

## Catatan Teknis

- Semua query input memakai **prepared statement** (anti SQL Injection).
- Semua output data ke HTML memakai `e()` / `htmlspecialchars` (anti XSS).
- Harga detail diambil dari database saat simpan, bukan dari form.
- Simpan detail memakai **database transaction** (insert detail + update total
  atomik) dengan `rollback` bila gagal.
- Setelah simpan memakai pola **Post/Redirect/Get** agar refresh tidak
  mengirim ulang data.
- Hapus barang dilindungi dua lapis: pengecekan di PHP **dan** FK
  `ON DELETE RESTRICT`.
- `transaksi_detail` memakai **primary key komposit**
  `(transaksi_id, barang_id)` untuk mencegah barang ganda.
