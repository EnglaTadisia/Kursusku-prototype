# Catatan Penggunaan AI

Rekap pemanfaatan AI selama pengembangan website **KursusKu UIN**.

## 1. Perancangan Logika Program

### Alat yang dipakai
* [isi nama AI, misalnya Claude / ChatGPT / Gemini]

### Keperluan
Mendapat gambaran alur kerja sistem pendaftaran kursus sebelum menulis kode PHP.

### Aktivitas
* Berdiskusi tentang cara memisahkan data kursus (`data.php`) dari halaman tampilan.
* Meminta penjelasan fungsi bantu di `helpers.php`, seperti format tanggal atau pengambilan data kursus berdasarkan ID.
* Membandingkan beberapa cara menyimpan data pendaftaran (session atau array).

### Contoh pertanyaan
> "Bagaimana cara menampilkan daftar kursus dari file data.php ke dalam pilihan dropdown di form pendaftaran?"

### Hasil
Mendapat contoh pendekatan dan penjelasan alurnya. Kode kemudian ditulis ulang dan disesuaikan dengan struktur folder proyek.

---

## 2. Validasi dan Pemrosesan Form

### Keperluan
Memastikan data dari `register.php` diterima dan diolah dengan benar oleh `process.php`.

### Aktivitas
* Menanyakan cara memeriksa input kosong dan format data yang salah.
* Mempelajari penggunaan `$_POST`, `isset()`, dan `htmlspecialchars()` untuk membersihkan input.
* Memahami cara mengarahkan pengguna ke halaman hasil setelah form terkirim.

### Contoh pertanyaan
> "Apa saja yang perlu divalidasi di process.php sebelum data pendaftaran ditampilkan?"

### Hasil
Memperoleh daftar hal yang perlu dicek, lalu menerapkannya sendiri pada kode proyek.

---

## 3. Penyempurnaan Antarmuka

### Keperluan
Merapikan tampilan dan menambahkan konten multimedia.

### Aktivitas
* Menanyakan penulisan tag `<video>` beserta atribut `controls` dan `poster`.
* Memperbaiki path file di folder `asset/video` yang tidak terbaca.
* Meminta saran penataan layout agar konsisten di setiap halaman.

### Contoh pertanyaan
> "Kenapa video di folder asset/video tidak muncul padahal kode HTML-nya sudah benar?"

### Hasil
Mengetahui bahwa penyebabnya ada pada penulisan path relatif, lalu memperbaikinya.

---

## 4. Pencarian dan Perbaikan Error

### Keperluan
Menelusuri penyebab halaman gagal menampilkan data.

### Aktivitas
* Mengaktifkan dan membaca pesan error PHP.
* Menelusuri data yang tidak sinkron antara daftar kursus dan halaman riwayat pendaftaran.
* Menguji ulang setelah setiap perbaikan.

### Contoh pertanyaan
> "Kenapa halaman history menampilkan kursus yang berbeda dari yang dipilih saat mendaftar?"

### Hasil
Ditemukan ketidakcocokan kunci data antar file, kemudian diperbaiki secara manual.

---

## 5. Pernyataan

AI hanya dipakai sebagai pendamping belajar dan pemberi masukan. Seluruh kode dipahami, diuji, dan diubah sesuai kebutuhan proyek sebelum digunakan, dan tanggung jawab atas hasil akhir ada pada pengembang.