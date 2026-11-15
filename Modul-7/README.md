# Modul 7 - Reporting

Praktikum Pengembangan Aplikasi Web untuk membuat laporan penjualan menggunakan PHP, MySQL, dan Chart.js. Implementasi mencakup Tugas Praktikum 1–4, tidak termasuk Tugas Pendahuluan.

## Fitur

- Filter periode berdasarkan `tanggal_mulai` dan `tanggal_selesai`, termasuk kedua tanggal batas.
- Validasi tanggal pada browser dan server, termasuk penolakan rentang tanggal terbalik.
- Grafik batang total pendapatan per hari menggunakan Chart.js.
- Tabel rekapitulasi harian dengan kolom No, Total Pendapatan, dan Tanggal Transaksi.
- Ringkasan jumlah pelanggan unik menggunakan `COUNT(DISTINCT pelanggan_id)` dan total pendapatan menggunakan `SUM(total)`.
- Cetak grafik, rekapitulasi, dan ringkasan melalui `window.print()`. Form filter dan tombol aksi disembunyikan saat dicetak.
- Unduhan rekapitulasi dan ringkasan berformat `.xls` sesuai periode filter.
- Pesan untuk periode tanpa transaksi, input tidak valid, kegagalan koneksi database, dan kegagalan memuat grafik.

## Struktur File

```text
Modul-7/
├── database/
│   └── penjualan.sql
├── export_excel.php
├── index.php
├── laporan.php
├── paw2026_07_tugas_praktikum.md
├── README.md
└── style.css
```

| File | Fungsi |
| --- | --- |
| `index.php` | Halaman filter, grafik, tabel rekapitulasi, ringkasan, dan kode JavaScript inline. |
| `laporan.php` | Koneksi database, validasi tanggal, query laporan, dan helper format tampilan. |
| `export_excel.php` | Mengunduh laporan melalui header respons Excel. |
| `style.css` | Tampilan halaman, penyesuaian layar kecil, dan aturan cetak. |
| `database/penjualan.sql` | Struktur dan data database untuk diimpor. |
| `paw2026_07_tugas_praktikum.md` | Materi dan instruksi praktikum. |

Tidak ada file JavaScript lokal terpisah. Kode JavaScript ditulis langsung dalam `index.php`, sedangkan pustaka Chart.js dimuat melalui CDN.

## Kebutuhan

- XAMPP atau lingkungan dengan Apache, PHP 8.0+, dan MySQL/MariaDB.
- Ekstensi PHP `mysqli` dengan dukungan `mysqlnd` untuk `get_result()`.
- Browser dengan JavaScript aktif.
- Koneksi internet untuk memuat Chart.js dari CDN.

## Cara Menjalankan

1. Simpan folder `Modul-7` di direktori proyek dalam `htdocs` XAMPP.
2. Aktifkan **Apache** dan **MySQL** melalui XAMPP Control Panel.
3. Buka phpMyAdmin, pilih menu **Import**, lalu impor `database/penjualan.sql`. Skrip sudah berisi perintah pembuatan dan pemilihan database `penjualan`.
4. Periksa konfigurasi koneksi pada `laporan.php`. Nilai bawaan menggunakan host `localhost`, pengguna `root`, kata sandi kosong, dan database `penjualan`. Konfigurasi dapat diganti melalui variabel lingkungan `DB_HOST`, `DB_USER`, `DB_PASS`, dan `DB_NAME`.
5. Buka `http://localhost/2026-2027_Gasal_PAW_C/Modul-7/`. Sesuaikan alamat apabila lokasi folder proyek berbeda.
6. Pilih tanggal mulai dan selesai, kemudian klik **Tampilkan**. Pada halaman awal, rekap baru ditampilkan setelah filter dikirim.

**Perhatian:** skrip impor menghapus dan membuat ulang tabel yang ada di database `penjualan`. Cadangkan data sebelum mengimpor ke database yang sudah digunakan.

## Database dan Data Pengujian

Modul ini menggunakan database **`penjualan`**, dengan struktur dan data yang disalin dari database Modul 6 (`tp6_praktikum`). Modul 7 tidak membaca langsung database Modul 6.

Database berisi tabel `barang`, `supplier`, `pelanggan`, `transaksi`, `transaksi_detail`, `pembayaran`, dan `user`. Laporan mengambil data dari tabel `transaksi`, khususnya kolom `waktu_transaksi`, `total`, dan `pelanggan_id`.

Gunakan periode **1–31 Oktober 2026** untuk mencoba data yang disertakan:

| Informasi | Nilai |
| --- | --- |
| Jumlah transaksi | 10 |
| Rentang transaksi | 1–30 Oktober 2026 |
| Pelanggan unik | 10 orang |
| Total pendapatan | Rp 824.800 |

Nilai tersebut mengikuti data ekspor yang disertakan dan dapat berubah jika transaksi diperbarui.

## Cetak dan Ekspor Excel

Setelah laporan ditampilkan:

- Klik **Cetak** untuk membuka dialog cetak browser. Pilih printer atau simpan sebagai PDF. Tunggu grafik selesai dimuat sebelum mencetak.
- Klik **Excel** untuk mengunduh laporan sesuai periode yang sedang ditampilkan.

Ekspor menggunakan tabel HTML yang dikirim dengan `Content-Type: application/vnd.ms-excel` dan nama berkas `.xls`, sesuai instruksi praktikum. Berkas bukan workbook Excel biner asli, sehingga Microsoft Excel dapat menampilkan peringatan ketidaksesuaian format dan ekstensi.

## Pemeriksaan

Jalankan pemeriksaan sintaks dari folder `Modul-7` menggunakan PowerShell:

```powershell
& "C:\xampp\php\php.exe" -l "index.php"
& "C:\xampp\php\php.exe" -l "laporan.php"
& "C:\xampp\php\php.exe" -l "export_excel.php"
```

Belum tersedia konfigurasi lint atau typecheck khusus proyek. Pengujian yang telah dijalankan mencakup sintaks PHP dan JavaScript inline, validasi tanggal, respons HTTP, laporan Oktober 2026, respons unduhan Excel, serta periode tanpa transaksi. Tampilan grafik dan dialog cetak masih perlu diperiksa langsung melalui browser.

## Pemecahan Masalah

- **Laporan tidak dapat dimuat:** pastikan MySQL aktif, impor `database/penjualan.sql`, lalu periksa konfigurasi pada `laporan.php`.
- **Rekap belum terlihat:** isi kedua tanggal dan klik **Tampilkan**.
- **Tidak ada transaksi:** coba periode 1–31 Oktober 2026 atau periksa tanggal transaksi pada database.
- **Grafik gagal dimuat:** periksa koneksi internet dan akses CDN. Tabel serta ringkasan tetap dapat digunakan.
