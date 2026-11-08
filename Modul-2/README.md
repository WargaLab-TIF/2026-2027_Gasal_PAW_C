# Modul 2 — Array dan Percabangan

Rangkuman materi yang dikerjakan pada Modul 2.

## Array

- **Tugas-1.php** — Mendeklarasikan dua array, yaitu `$matkul` yang berisi
  delapan nama mata kuliah dan `$praktikum` yang berisi dua mata kuliah yang
  sedang dijadikan praktikum. Indeks `$matkul` bernilai `0` sampai `7` untuk
  `PTI`, `ALPRO`, `DPW`, `STRUKDAT`, `JARKOM`, `PAW`, `PSBF`, dan `RPL`.

## Perulangan

- **Tugas-1.php** — Menelusuri `$matkul` dengan perulangan `for` yang berhenti
  pada `count($matkul)` dan mengambil elemennya lewat indeks `$i`.

  **Cara kerja:**

  1. Perulangan `for` memakai `$i` sebagai penghitung, mulai dari `0` dan
     berhenti selama `$i` masih lebih kecil dari `count($matkul)`, yaitu `8`.
     Jadi perulangan berjalan delapan kali untuk indeks `0` sampai `7`.
  2. Tiap iterasi mengambil satu elemen, yaitu `$matkul[$i]`.
  3. Elemen tersebut dicek dengan `in_array($matkul[$i], $praktikum)`. Fungsi ini
     bernilai `true` hanya bila nilainya ada di dalam `$praktikum`, yaitu
     `JARKOM` atau `PAW`.
  4. Bila hasilnya `true`, cabang `if` mencetak keterangan sedang diambil
     sebagai praktikum.
  5. Bila hasilnya `false`, diperiksa lagi oleh `elseif`, yaitu apakah `$i`
     bernilai `6` atau `7`. Dua indeks itu adalah `PSBF` dan `RPL`, sehingga
     keduanya mencetak keterangan belum diambil.
  6. Bila kedua kondisi tersebut tidak terpenuhi, cabang `else` mencetak
     keterangan sudah diambil pada semester lalu. Indeks `0` sampai `5` yang
     bukan praktikum masuk ke sini.

  Keluaran:

  ```text
  Saya sudah mengambil matkul PTI semester lalu
  Saya sudah mengambil matkul ALPRO semester lalu
  Saya sudah mengambil matkul DPW semester lalu
  Saya sudah mengambil matkul STRUKDAT semester lalu
  Saya sedang mengambil matkul JARKOM termasuk praktikum nya
  Saya sedang mengambil matkul PAW termasuk praktikum nya
  Saya belum mengambil matkul PSBF
  Saya belum mengambil matkul RPL
  ```

- **Tugas-2.php** — Menelusuri `$matkul` dengan `foreach` yang menyimpan tiap
  elemen ke variabel `$m`.

  **Cara kerja:**

  1. `foreach` mengambil elemen `$matkul` satu per satu dan menyimpannya ke
     variabel `$m`. Berbeda dengan `for`, tidak ada penghitung indeks, dan
     urutan pemrosesannya mengikuti urutan elemen di dalam array.
  2. Nilai `$m` lalu diperiksa oleh `switch`.
  3. Enam baris `case` mulai dari `PTI` sampai `PAW` tidak berisi perintah apa
     pun dan tidak dipisahkan oleh `break`. Karena itu saling jatuh
     (*fall-through*), dan apa pun yang nilai `$m`-nya salah satu dari enam
     mata kuliah tersebut akan melewati semua `case` kosong sampai ke satu
     `echo` di bawahnya.
  4. `break` setelah `echo` tersebut menghentikan penelusuran, sehingga nilai
     `$m` tidak ikut jatuh ke `default`.
  5. `default` hanya dijalankan bila `$m` tidak cocok dengan satu pun `case`,
     yaitu untuk `PSBF` dan `RPL`.

  Keluaran:

  ```text
  Saya suka PTI
  Saya suka ALPRO
  Saya suka DPW
  Saya suka STRUKDAT
  Saya suka JARKOM
  Saya suka PAW
  Saya tidak mengambil matkul PSBF
  Saya tidak mengambil matkul RPL
  ```

- **Tugas-3.php** — Perulangan `do ... while` yang mencetak angka mulai dari `0`
  dengan menaikkan `$angka` sebesar `4` sampai nilainya melebihi `20`, sehingga
  menghasilkan `0`, `4`, `8`, `12`, `16`, dan `20`.

  **Cara kerja:**

  1. `$angka` diinisialisasi dengan nilai `0` sebelum perulangan dimulai.
  2. `do ... while` adalah perulangan yang kondisi akhirnya diperiksa *setelah*
     badan perulangan dijalankan, sehingga badan perulangan dijamin berjalan
     minimal satu kali.
  3. Tiap iterasi mencetak nilai `$angka`, lalu menaikkan nilainya sebesar `4`
     melalui `$angka += 4`.
  4. Setelah itu kondisi `$angka <= 20` baru diperiksa. Karena pemeriksaan
     terjadi sesudah kenaikan, nilai `20` masih tercetak sebelum perulangan
     berhenti: `0` → `4` → `8` → `12` → `16` → `20`, dan pada langkah terakhir
     nilainya menjadi `24` sehingga kondisi tidak terpenuhi lagi.

  Keluaran:

  ```text
  0
  4
  8
  12
  16
  20
  ```

## Percabangan

- **Tugas-1.php** — Percabangan `if`/`elseif`/`else` yang memakai `in_array()`
  untuk memeriksa apakah elemen yang sedang ditelusuri termasuk array
  `$praktikum`. Elemen yang cocok mencetak keterangan sedang diambil sebagai
  praktikum, indeks `6` atau `7` mencetak keterangan belum diambil, dan
  sisanya mencetak keterangan sudah diambil pada semester lalu.
- **Tugas-2.php** — Percabangan `switch` atas nilai `$m`. Enam mata kuliah
  ditulis sebagai `case` berurutan tanpa `break` di antaranya sehingga
  fall-through ke blok yang sama, sedangkan `PSBF` dan `RPL` ditangani oleh
  `default`.