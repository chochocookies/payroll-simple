# Payroll Simple 💰


**Payroll Simple** adalah aplikasi berbasis web yang dibangun menggunakan *framework* Laravel untuk menyederhanakan manajemen data karyawan dan proses kalkulasi penggajian secara digital. Proyek ini dirancang dengan struktur kode yang bersih untuk memberikan kemudahan dalam pengelolaan administrasi HR internal.

---

## ✨ Fitur Utama

- 👥 **Manajemen Karyawan:** Fitur CRUD (Create, Read, Update, Delete) lengkap untuk mengelola data profil dan informasi kontrak staf.
- 💼 **Manajemen Jabatan & Departemen:** Pengelompokan struktur organisasi kerja secara dinamis.
- 💵 **Kalkulasi Gaji Otomatis:** Perhitungan gaji bersih berdasarkan komponen gaji pokok, tunjangan, dan potongan yang fleksibel.
- 📊 **Dashboard Ringkas:** Menampilkan metrik utama seperti total pengeluaran gaji bulanan dan statistik jumlah karyawan aktif.
- 🔐 **Autentikasi Aman:** Sistem login terproteksi bawaan Laravel untuk menjaga keamanan data sensitif perusahaan.

---

## 🛠️ Teknologi yang Digunakan

- **Backend:** [Laravel](https://laravel.com) (PHP 8.2+)
- **Frontend:** [Tailwind CSS](https://tailwindcss.com) / Blade Templating Engine (disesuaikan dengan aset proyek Anda)
- **Database:** MySQL / PostgreSQL

---

## 🚀 Panduan Instalasi Lokal

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek ini di komputer lokal Anda:

### Prasyarat
Pastikan Anda sudah menginstal alat-alat berikut:
- PHP (minimal versi 8.2)
- [Composer](https://getcomposer.org)
- Node.js & NPM
- Layanan Database (XAMPP, Laragon, Docker, atau MySQL Server)

### Langkah-langkah
1. **Kloning Repositori**
   ```bash
   git clone https://github.com
   cd payroll-simple
   ```

2. **Instal Dependensi Backend (Composer)**
   ```bash
   composer install
   ```

3. **Instal Dependensi Frontend (NPM)**
   ```bash
   npm install && npm run dev
   ```

4. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Buka file `.env` yang baru dibuat dan sesuaikan konfigurasi database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_payroll_anda
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Database & Seeding**
   Jalankan perintah ini untuk membuat tabel beserta data sampel (jika tersedia seeder):
   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   ```
   Aplikasi sekarang dapat diakses melalui browser Anda di alamat: `http://127.0.0.1:8000`

---

## 📂 Struktur Proyek Utama

- `app/Http/Controllers/` - Logika utama alur fitur penggajian dan karyawan.
- `database/migrations/` - Struktur skema tabel basis data sistem *payroll*.
- `resources/views/` - Halaman antarmuka pengguna (UI) berbasis komponen Blade.
- `routes/web.php` - Daftar rute navigasi aplikasi web.

---

## 📝 Lisensi

Proyek ini bersifat *open-source* dan didistribusikan di bawah lisensi [MIT License](LICENSE).
