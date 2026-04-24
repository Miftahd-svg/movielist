
---

# Proyek Ujian Praktik Mandiri - MovieWatch

### Identitas Mahasiswa
* **Nama:** Miftahuda Adhananto
* **Instansi:** Universitas Duta Bangsa
* **Mata Kuliah:** (Isi dengan nama mata kuliahmu, misal: Pemrograman Web)
* **Teknologi:** Laravel 12, Tailwind CSS v4, MySQL, Vite.

---

### Penjelasan Tema Kasus
**MovieWatch** adalah sebuah aplikasi berbasis web yang dirancang untuk membantu pengguna mengelola daftar tontonan film pribadi (Watchlist) mereka. Aplikasi ini berfungsi sebagai asisten digital untuk mencatat film-film yang ingin ditonton atau yang sudah selesai ditonton agar koleksi hiburan pengguna lebih terorganisir.

**Alur Bisnis Utama:**
1.  **Autentikasi:** Pengguna wajib mendaftarkan akun dan masuk (Login) untuk menjaga privasi daftar tontonan masing-masing.
2.  **Manajemen Koleksi (CRUD):**
    * **Create:** Pengguna dapat menambahkan judul film baru beserta genrenya ke dalam daftar.
    * **Read:** Menampilkan daftar film yang telah disimpan dalam bentuk tabel yang modern dan bersih.
    * **Update:** Pengguna dapat mengubah detail film (judul/genre) serta memperbarui status tontonan.
    * **Delete:** Pengguna dapat menghapus film yang tidak lagi diinginkan dari daftar mereka.

---

### Fitur Utama & Keunggulan
* **Secure Authentication:** Implementasi sistem Session Laravel dengan enkripsi password (Bcrypt) untuk keamanan data pengguna.
* **Modern UI/UX:** Desain minimalis dengan palet warna **Navy Dark** (#0a192f) dan **Gold Brown** (#996515), menggunakan font *Instrument Sans* untuk estetika premium.
* **Inline Editing:** Fitur pembaruan data yang cepat menggunakan teknologi Alpine.js tanpa perlu memuat ulang halaman (Real-time feel).
* **Responsive Design:** Antarmuka yang optimal baik diakses melalui desktop maupun perangkat mobile.

---

### Cara Instalasi (Opsional untuk Nilai Tambah)
1.  Clone repository ini.
2.  Jalankan `composer install` dan `npm install`.
3.  Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database.
4.  Impor file database `movie_watchlist_db.sql` yang tersedia di folder root.
5.  Jalankan `php artisan migrate`.
6.  Jalankan aplikasi dengan `php artisan serve` dan `npm run dev`.

---

