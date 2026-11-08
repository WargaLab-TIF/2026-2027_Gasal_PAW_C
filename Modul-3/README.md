# Modul 3 — Manipulasi Array

Rangkuman materi yang dikerjakan pada Modul 3.

## Array Terindeks

- **Tugas-1.1.php** — Mendeklarasikan array terindeks `$fruits` berisi tiga
  elemen, lalu menambah lima elemen dengan `array_push()` dan menampilkan
  elemen bernilai indeks tertinggi.

  **Cara kerja:**

  1. `$fruits` dideklarasikan sebagai array terindeks berisi `Avocado`,
     `Blueberry`, dan `Cherry`.
  2. `array_push()` menambahkan lima elemen di akhir array, yaitu `Durian`,
     `Elderberry`, `Fig`, `Grape`, dan `Honeydew`. Elemen baru otomatis
     mendapat indeks `3` sampai `7`.
  3. `implode('", "', $fruits)` menyatukan seluruh elemen menjadi satu string
     dengan pemisah `", "` supaya tampil menyerupai bentuk array.
  4. `end($fruits)` memindahkan pointer array ke elemen terakhir dan
     mengembalikan nilainya, yaitu `Honeydew`.

  Keluaran:

  ```text
  fruits = ("Avocado", "Blueberry", "Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew")
  Nilai dengan indeks tertinggi: Honeydew
  ```

- **Tugas-1.2.php** — Mendeklarasikan ulang `$fruits` dengan delapan elemen
  (sama seperti hasil Tugas-1.1.php), menghapus satu elemen dengan `unset()`,
  lalu menampilkan kembali isi array.

  **Cara kerja:**

  1. `$fruits` dideklarasikan ulang berisi delapan elemen: `Avocado`,
     `Blueberry`, `Cherry`, `Durian`, `Elderberry`, `Fig`, `Grape`, dan
     `Honeydew`.
  2. `unset($fruits[1])` menghapus elemen berindeks `1`, yaitu `Blueberry`.
     Indeks elemen lain tidak bergeser sehingga tetap `0`, `2`, `3`, dan
     seterusnya.
  3. `implode()` menampilkan kembali isi array tanpa `Blueberry`.
  4. `end($fruits)` menampilkan elemen terakhir, yaitu tetap `Honeydew`.

  Keluaran:

  ```text
  Data Blueberry dihapus.
  fruits = ("Avocado", "Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew")
  Nilai dengan indeks tertinggi: Honeydew
  ```

## Perulangan Array

- **Tugas-2.1.php** — Menambah lima elemen ke array memakai perulangan `for`,
  lalu menampilkan panjang array dan seluruh isinya.

  **Cara kerja:**

  1. `$fruits` dideklarasikan dengan tiga elemen awal.
  2. Perulangan `for` berjalan lima kali (`$i` dari `1` sampai `5`) dan
     menambahkan elemen baru lewat `$fruits[] = ...`, sehingga terbentuk
     `Buah Tambahan 1` sampai `Buah Tambahan 5`.
  3. `count($fruits)` menghitung jumlah elemen, yang berubah dari `3` menjadi
     `8`.
  4. Perulangan `for` kedua menelusuri indeks `0` sampai `7` dan menampilkan
     setiap elemen.

  Keluaran:

  ```text
  Panjang array saat ini: 8
  Avocado
  Blueberry
  Cherry
  Buah Tambahan 1
  Buah Tambahan 2
  Buah Tambahan 3
  Buah Tambahan 4
  Buah Tambahan 5
  ```

- **Tugas-2.2.php** — Menampilkan seluruh elemen array `$vegies` dengan
  perulangan `for` berbasis `count()`.

  **Cara kerja:**

  1. `$vegies` berisi tiga elemen: `Carrot`, `Broccoli`, dan `Spinach`.
  2. `count($vegies)` menyimpan jumlah elemen ke `$vegiesLength`.
  3. `for` menelusuri indeks `0` sampai `$vegiesLength - 1` dan menampilkan
     tiap elemen.

  Keluaran:

  ```text
  Carrot
  Broccoli
  Spinach
  ```

## Array Asosiatif

- **Tugas-3.1.php** — Membuat array asosiatif `$height`, menambah lima data,
  menampilkan nilai terakhir, lalu menghapus satu data.

  **Cara kerja:**

  1. `$height` adalah array asosiatif dengan nama sebagai kunci dan tinggi
     badan sebagai nilai, berisi `Andy`, `Barry`, dan `Charlie`.
  2. Operator `+=` menggabungkan lima pasangan kunci-nilai baru: `David`,
     `Ethan`, `Frank`, `George`, dan `Harry`.
  3. `foreach` menampilkan setiap pasangan `kunci=>nilai`.
  4. `end($height)` menampilkan nilai terakhir, yaitu tinggi `Harry` (`182`).
  5. `unset($height['Barry'])` menghapus entri `Barry`.
  6. `end($height)` kembali menampilkan nilai terakhir; karena `Barry` bukan
     elemen terakhir, hasilnya tetap `182`.

  Keluaran:

  ```text
  height = ("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170", "David"=>"180", "Ethan"=>"172", "Frank"=>"168", "George"=>"175", "Harry"=>"182", )
  Nilai dengan indeks terakhir: 182
  Nilai dengan indeks terakhir setelah dihapus: 182
  ```

- **Tugas-3.2.php** — Mengambil nilai tertentu dari array asosiatif memakai
  `array_values()`.

  **Cara kerja:**

  1. `$weight` adalah array asosiatif berisi berat badan `Andy`, `Barry`, dan
     `Charlie`.
  2. `array_values($weight)` mengambil semua nilai tanpa kuncinya sehingga
     menghasilkan array terindeks `[70, 65, 75]`.
  3. Nilai pada indeks `1`, yaitu data kedua (`65`), ditampilkan.

  Keluaran:

  ```text
  Data kedua: 65
  ```

## Menampilkan Array Asosiatif

- **Tugas-4.1.php** — Menampilkan array asosiatif `$height` dengan `foreach`.

  **Cara kerja:**

  1. `$height` dideklarasikan ulang berisi delapan elemen, lalu `Barry`
     dihapus dengan `unset()` agar isinya sama seperti hasil Tugas-3.1.php.
  2. `foreach` menelusuri array asosiatif `$height`.
  3. Tiap iterasi memisahkan kunci ke `$name` dan nilai ke `$h`, lalu keduanya
     dicetak dalam satu kalimat.

  Keluaran:

  ```text
  Andy is 176 cm tall.
  Charlie is 170 cm tall.
  David is 180 cm tall.
  Ethan is 172 cm tall.
  Frank is 168 cm tall.
  George is 175 cm tall.
  Harry is 182 cm tall.
  ```

- **Tugas-4.2.php** — Menampilkan array asosiatif `$weight` dengan `for`
  berbantuan `array_keys()`.

  **Cara kerja:**

  1. `$weight` dideklarasikan kembali sebagai array asosiatif.
  2. `array_keys($weight)` mengambil semua kunci (nama) menjadi array
     terindeks `[Andy, Barry, Charlie]`.
  3. `for` menelusuri array kunci; nilai `$name` dipakai untuk mengambil berat
     badan dari `$weight[$name]`.
  4. Setiap pasangan nama dan berat ditampilkan.

  Keluaran:

  ```text
  Andy is 70 kg.
  Barry is 65 kg.
  Charlie is 75 kg.
  ```

## Array Multidimensi

- **Tugas-5.1.php** — Menyusun data mahasiswa dalam array multidimensi dan
  menampilkannya sebagai tabel HTML.

  **Cara kerja:**

  1. `$students` adalah array multidimensi; tiap elemennya berupa array berisi
     `Name`, `NIM`, dan `Mobile`.
  2. `array_push()` menambahkan lima baris data baru (`Daniel` sampai `Hannah`)
     sehingga totalnya menjadi delapan baris.
  3. Skrip mencetak tabel HTML (`<table>`) dengan header `Name`, `NIM`, dan
     `Mobile`.
  4. `foreach` membuat satu baris `<tr>` per mahasiswa dan mengisi kolomnya
     dari `$student[0]`, `$student[1]`, dan `$student[2]`.

  Keluaran: sebuah tabel HTML berisi delapan baris data mahasiswa.

## Fungsi Array

- **Tugas-6.1.php** — Ringkasan penggunaan berbagai fungsi bawaan array.

  **Cara kerja:**

  1. `array_push()` menambahkan satu elemen di akhir array.
  2. `array_merge()` menggabungkan dua array menjadi satu.
  3. `array_values()` mengambil nilai array asosiatif tanpa kuncinya.
  4. `array_search()` mencari posisi sebuah nilai di dalam array.
  5. `array_filter()` membuang nilai yang dianggap `false`, yaitu `0`, `false`,
     dan `""`.
  6. `sort()` mengurutkan menaik dan `rsort()` mengurutkan menurun.
  7. `asort()`, `ksort()`, `arsort()`, dan `krsort()` mengurutkan array
     asosiatif berdasarkan nilai atau kunci, meskipun hasilnya tidak dicetak.

  Keluaran:

  ```text
  Hasil array_push: A B
  Hasil array_merge: A B C
  Hasil array_values: 1 2
  Hasil array_search (mencari B): 1
  Hasil array_filter: 1 2 3 array
  Hasil sort: 1 2 3
  Hasil rsort: 3 2 1
  ```
