# Modul 4 — Form Input Handling

Nama: Idham Kholid Abidin
NIM: 25-013

Praktikum PHP Modul 4 tentang pemrosesan form, validasi server-side, dan self-submission.
Pengerjaan dilakukan berurutan: **4.3 → 4.3.1 → 4.3.2**.

## Peta soal ke file

| Sub-bab / Langkah | Soal | File |
|---|---|---|
| 4.3 Langkah #1 | Form HTML dengan method POST ke `processData.php` | `4.3/processData_form.html` |
| 4.3 Langkah #2 | Menampilkan seluruh data POST dengan `foreach` | `4.3/processData.php` |
| 4.3 Langkah #3 | Pengujian POST vs GET | `4.3/3_hasil_pengujian.md` |
| 4.3.1 Langkah #1–#2 | `validateName` versi boolean (snapshot) | `4.3.1/3_hasil_pengujian.md` |
| 4.3.1 Langkah #3 | Pengujian versi boolean | `4.3.1/3_hasil_pengujian.md` |
| 4.3.1 Langkah #4–#5 | `validateName` versi `$errors` + tampilan error | `4.3.1/validate.inc`, `4.3.1/processData.php` |
| 4.3.1 Langkah #6 | Pengujian pesan error per field | `4.3.1/6_hasil_pengujian.md` |
| 4.3.1 (pengujian manual) | Salinan form 4.3 dengan action relatif ke `processData.php` | `4.3.1/processData_form.html` |
| 4.3.2 Langkah #1–#3 | Form diubah ke `.php` dan self-submission | `4.3.2/processData_form.php`, `4.3.2/form.inc` |
| 4.3.2 Langkah #3 | Pengujian form PHP | `4.3.2/3_hasil_pengujian.md` |
| 4.3.2 Langkah #4–#5 | Skenario error #1 (form kosong) | `4.3.2/form.inc`, `4.3.2/6_hasil_pengujian.md` |
| 4.3.2 Langkah #6 | Pengujian skenario #1 | `4.3.2/6_hasil_pengujian.md` |
| 4.3.2 Langkah #7 | Repopulasi isian sebelumnya | `4.3.2/form.inc`, `4.3.2/8_hasil_pengujian.md` |
| 4.3.2 Langkah #8 | Pengujian skenario #2 | `4.3.2/8_hasil_pengujian.md` |
| 4.3.2 Langkah #9 | Validasi semua field + error per field | `4.3.2/validate.inc`, `4.3.2/9_hasil_pengujian.md` |

## Struktur folder

```text
25-013_Idham_Kholid_Abidin/
├── README.md
├── tugas_praktikum_4.md
├── 4.3/
│   ├── processData_form.html
│   ├── processData.php
│   └── 3_hasil_pengujian.md
├── 4.3.1/
│   ├── processData_form.html
│   ├── validate.inc
│   ├── processData.php
│   ├── 3_hasil_pengujian.md
│   └── 6_hasil_pengujian.md
└── 4.3.2/
    ├── processData_form.php
    ├── form.inc
    ├── validate.inc
    ├── 3_hasil_pengujian.md
    ├── 6_hasil_pengujian.md
    ├── 8_hasil_pengujian.md
    └── 9_hasil_pengujian.md
```

## Cara menjalankan

XAMPP Apache harus berjalan, lalu buka URL berikut di browser:

- Form 4.3 (POST ke halaman proses):
  `http://localhost/2026-2027_Gasal_PAW_C/Modul-4/25-013_Idham_Kholid_Abidin/4.3/processData_form.html`
- Proses 4.3 langsung:
  `http://localhost/2026-2027_Gasal_PAW_C/Modul-4/25-013_Idham_Kholid_Abidin/4.3/processData.php`
- Form uji 4.3.1 (salinan form 4.3):
  `http://localhost/2026-2027_Gasal_PAW_C/Modul-4/25-013_Idham_Kholid_Abidin/4.3.1/processData_form.html`
- Proses + validasi 4.3.1 langsung:
  `http://localhost/2026-2027_Gasal_PAW_C/Modul-4/25-013_Idham_Kholid_Abidin/4.3.1/processData.php`
- Form self-submission 4.3.2:
  `http://localhost/2026-2027_Gasal_PAW_C/Modul-4/25-013_Idham_Kholid_Abidin/4.3.2/processData_form.php`

Catatan: form `4.3.1/processData_form.html` adalah salinan persis dari `4.3/processData_form.html`.
Karena atribut `action`-nya relatif (`processData.php`), form tersebut otomatis mengirim POST ke
`4.3.1/processData.php` di folder yang sama, sehingga validasi 4.3.1 dapat dicoba langsung lewat browser.

## Ringkasan tiap sub-bab

- **4.3** — Form HTML mengirim data dengan method POST. `processData.php` menampilkan semua
  pasangan key/value dari `$_POST` memakai `foreach`. Pengujian GET menunjukkan data berpindah
  ke query string dan `$_POST` menjadi kosong.
- **4.3.1** — Validasi server-side sederhana untuk surname. Versi boolean hanya memberi pesan
  umum; versi `$errors` memberi pesan `required`/`invalid` per field.
- **4.3.2** — Form diubah menjadi PHP dengan self-submission. `form.inc` dipisahkan dari proses,
  isian sebelumnya ditampilkan kembali saat error (kecuali password), dan validasi diperluas
  untuk email, password, address, state, dan sex dengan pesan error di dekat setiap field.

## Catatan pengujian

Semua hasil di file `*_hasil_pengujian.md` berasal dari eksekusi nyata memakai Apache/PHP 8.2.12
dan `curl`. Perintah yang dipakai disertakan agar dapat direproduksi. Tidak ada dependensi
eksternal; CSS ditulis inline di halaman.
