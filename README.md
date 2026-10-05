# Aplikasi Sistem Manajemen Data Mahasiswa (Keamanan Sistem Informasi)

Aplikasi web sederhana ini dibangun menggunakan **Framework Laravel** sebagai tugas Quiz Praktek Mata Kuliah Keamanan Sistem Informasi, Politeknik Negeri Padang.

## 🔒 Fitur Keamanan yang Diimplementasikan

1. **Autentikasi & Enkripsi Password:**
   - Fitur Login, Register, dan Logout menggunakan Laravel Authentication.
   - Password disimpan dengan aman menggunakan algoritma hashing **Bcrypt**.

2. **Proteksi CSRF (Cross-Site Request Forgery):**
   - Seluruh form (POST, PUT, DELETE) dilindungi menggunakan token `@csrf` bawaan Laravel untuk mencegah eksekusi perintah dari pihak ketiga yang tidak sah.

3. **Validasi Input Server-Side:**
   - Semua input form divalidasi di sisi server sebelum diproses ke database untuk mencegah *SQL Injection* dan memastikan integritas data.
   - Penanganan pesan error yang *user-friendly* apabila input tidak sesuai.

4. **Proteksi Akses (Route Middleware & Role Management):**
   - Halaman sistem diproteksi menggunakan middleware `auth`.
   - Menerapkan **Role Management** (Admin & User).
   - **Admin:** Memiliki hak akses penuh untuk CRUD (Create, Read, Update, Delete) data utama dan melihat log sistem.
   - **User:** Memiliki hak akses terbatas (hanya Read/melihat data).
   - Akses yang tidak sah antar role akan dicegah secara otomatis oleh Route Middleware.

5. **Throttle Login Attempt (Fitur Bonus):**
   - Membatasi jumlah percobaan login maksimal 5 kali per menit. Jika gagal melebihi batas, user harus menunggu, yang berguna untuk mencegah serangan *Brute Force*.

6. **Audit Log Aktivitas User (Fitur Bonus):**
   - Sistem mencatat semua aktivitas krusial user (seperti Login, Logout, Tambah Data, Edit Data, dan Hapus Data) beserta alamat IP ke dalam database untuk pemantauan keamanan.

---

## 🛠️️ Cara Menjalankan Aplikasi

1. **Persiapan:**
   - Pastikan Anda sudah menginstal PHP, Composer, dan MySQL/MariaDB di komputer Anda.
   - Ekstrak file project ini.

2. **Install Dependensi:**
   Buka terminal di dalam folder project, lalu jalankan perintah:
   > composer install

3. **Konfigurasi Environment:**
   - Salin file `.env.example` dan ubah namanya menjadi `.env`.
   - Buka file `.env` dan atur koneksi database Anda (sesuaikan `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`).
   - Generate application key dengan perintah:
   > php artisan key:generate

4. **Migrasi dan Seeder Database:**
   Jalankan perintah berikut untuk membuat tabel dan mengisi akun pengguna default:
   > php artisan migrate --seed

5. **Kredensial Akun Default (Hasil Seeder):**
   - **Akun Admin:**
     Email: admin@pnp.ac.id
     Password: admin123
   - **Akun User:**
     Email: user@pnp.ac.id
     Password: user123

6. **Menjalankan Server:**
   Jalankan perintah ini untuk mengaktifkan local server Laravel:
   > php artisan serve

   Buka browser Anda dan akses tautan berikut: `http://127.0.0.1:8000`