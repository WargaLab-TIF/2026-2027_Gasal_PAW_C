# Modul 4 - Form Processing & Validasi

**Nama:** Rizky Ahmad Nasrulloh
**NIM:** 25-022
**Mata Kuliah:** Praktikum Pengembangan Aplikasi Web C

Modul 4 membahas pemrosesan data form dengan PHP, mulai dari menampilkan data
yang dikirim, validasi input, sampai menampilkan kembali form beserta pesan error.

---

## Struktur Folder

```
25-022_Rizky Ahmad Nasrulloh/
├── 4.3/
│   ├── processData_form.html
│   └── processData.php
├── 4.3.1/
│   ├── processData_form.html
│   ├── validate.inc
│   └── processData.php
└── 4.3.2/
    ├── index.php
    ├── form.inc
    └── validate.inc
```

---

## 4.3 - Menampilkan Data yang Di-submit

Form berisi data person (surname, email, password, address, state, country,
gender, vegetarian) yang dikirim dengan `method="POST"` ke `processData.php`.

`processData.php` melakukan perulangan pada `$_POST` untuk menampilkan seluruh
pasangan key dan value:

```php
foreach ($_POST as $key => $value) {
    echo "($key) => ($value) <br/>";
}
```

Hasil: semua field yang dikirim langsung tercetak tanpa penyaringan.

---

## 4.3.1 - Validasi Sederhana

Validasi dipisah ke file `validate.inc` agar bisa dipakai ulang. Fungsi
`validateName()` mengecek surname:

- kosong -> `required`
- tidak cocok pola `/^[a-zA-Z'-]+$/` -> `invalid`

`processData.php` memanggil fungsi tersebut lalu menampilkan daftar error,
atau `Data OK!` bila tidak ada masalah.

Catatan: error dikumpulkan lewat parameter by-reference `&$errors`.

---

## 4.3.2 - Validasi Lengkap + Form Sticky

Versi ini menggabungkan semuanya dalam satu halaman:

- `index.php` -> controller, cek apakah form sudah di-submit
- `form.inc` -> tampilan form, value diisi ulang dari `$_POST` (sticky form)
- `validate.inc` -> kumpulan fungsi validasi

Validasi yang tersedia:

| Fungsi | Field | Aturan |
|---|---|---|
| `validateName()` | surname | wajib diisi, hanya huruf/`'`/`-` |
| `validateEmail()` | email | wajib diisi, format email valid (`filter_var`) |
| `validatePassword()` | passwd | wajib diisi, minimal 6 karakter |

Alur:

1. Form belum di-submit -> tampilkan form kosong.
2. Form di-submit dan ada error -> tampilkan pesan error, form ditampilkan lagi
   dengan data sebelumnya tetap terisi.
3. Form di-submit tanpa error -> tampil `Form submitted successfully with no errors`.

Nilai input di-escape dengan `htmlspecialchars()` supaya aman dari XSS.

---

## Cara Menjalankan

Pastikan XAMPP (Apache) berjalan, lalu buka:

- `http://localhost/2026-2027_Gasal_PAW_C/Modul-4/25-022_Rizky%20Ahmad%20Nasrulloh/4.3/processData_form.html`
- `http://localhost/2026-2027_Gasal_PAW_C/Modul-4/25-022_Rizky%20Ahmad%20Nasrulloh/4.3.1/processData_form.html`
- `http://localhost/2026-2027_Gasal_PAW_C/Modul-4/25-022_Rizky%20Ahmad%20Nasrulloh/4.3.2/index.php`
