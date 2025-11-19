# 🎓 Skillbridge - Platform Pelatihan & Lowongan Kerja

Platform berbasis web yang menghubungkan mahasiswa dengan perusahaan mitra untuk pelatihan dan lowongan kerja.

## 📋 Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Teknologi](#teknologi)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Database Seeding](#database-seeding)
- [Akun Default](#akun-default)
- [Struktur Project](#struktur-project)
- [Troubleshooting](#troubleshooting)

---

## 🚀 Fitur Utama

- **Autentikasi Multi-Role**: Admin, Mitra (Perusahaan), Mahasiswa
- **Manajemen Lowongan Kerja**: Posting, edit, dan kelola lowongan
- **Manajemen Pelatihan**: Kursus dan pelatihan online/offline
- **Profil Perusahaan**: Halaman profil mitra dengan verifikasi
- **Dashboard**: Dashboard terpisah untuk setiap role
- **Responsive Design**: Tampilan mobile-friendly

---

## 🛠️ Teknologi

- **Backend**: Laravel 11
- **Frontend**: Blade Template, CSS3, JavaScript
- **Database**: MySQL
- **Icons**: Font Awesome 6.4.0
- **PHP**: >= 8.2

---

## 📦 Persyaratan Sistem

Pastikan sistem Anda telah terinstall:

- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js & NPM (opsional, untuk asset compilation)
- Git

---

## 📥 Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd skillbridge
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Copy File Environment

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

## ⚙️ Konfigurasi

### 1. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=skillbridge
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Buat Database

Buat database MySQL dengan nama `skillbridge`:

```sql
CREATE DATABASE skillbridge;
```

### 3. Jalankan Migration

```bash
php artisan migrate
```

### 4. Link Storage (untuk upload file)

```bash
php artisan storage:link
```

---

## 🎯 Database Seeding

### Seed Data Default

```bash
php artisan db:seed
```

### Seed Spesifik

```bash
# Seed Users
php artisan db:seed --class=UserSeeder

# Seed Mahasiswa
php artisan db:seed --class=MahasiswaSeeder

# Seed Mitra
php artisan db:seed --class=MitraSeeder

# Seed Lowongan
php artisan db:seed --class=LokerSeeder

# Seed Pelatihan
php artisan db:seed --class=PelatihanSeeder
```

---

## 🏃 Menjalankan Aplikasi

### Development Server

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://localhost:8000**

### Dengan Custom Port

```bash
php artisan serve --port=8080
```

---

## 👤 Akun Default

Setelah seeding, gunakan akun berikut untuk login:

### Admin
- **Email**: `admin@example.com`
- **Password**: `password`
- **Role**: Admin

### Mitra (Perusahaan)
- **Email**: `mitra@example.com`
- **Password**: `password`
- **Role**: Mitra

### Mahasiswa
- **Email**: `user@example.com`
- **Password**: `password`
- **Role**: Mahasiswa

---

## 📁 Struktur Project

```
skillbridge/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── LokerController.php
│   │   │   ├── PelatihanController.php
│   │   │   └── MitraController.php
│   │   └── Middleware/
│   └── Models/
│       ├── User.php
│       ├── Mahasiswa.php
│       ├── Mitra.php
│       ├── Loker.php
│       └── Pelatihan.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── UserSeeder.php
│       ├── MahasiswaSeeder.php
│       ├── MitraSeeder.php
│       ├── LokerSeeder.php
│       └── PelatihanSeeder.php
├── resources/
│   └── views/
│       ├── auth/
│       │   └── login.blade.php
│       ├── layout/
│       │   ├── main.blade.php
│       │   ├── dashboard/
│       │   │   └── main.blade.php
│       │   └── partial/
│       │       ├── nav.blade.php
│       │       └── footer.blade.php
│       ├── components/
│       │   ├── navbar.blade.php
│       │   └── footer.blade.php
│       └── page/
│           ├── home.blade.php
│           ├── loker/
│           │   ├── index.blade.php
│           │   └── show.blade.php
│           └── pelatihan/
│               ├── index.blade.php
│               └── detail.blade.php
├── routes/
│   └── web.php
├── public/
│   ├── assets/
│   │   └── mitra/
│   │       └── logo/
│   └── index.php
├── .env
├── .env.example
├── composer.json
└── artisan
```

---

## 🔧 Command Artisan Berguna

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize untuk production
php artisan optimize

# Rollback migration
php artisan migrate:rollback

# Fresh migration dengan seeding
php artisan migrate:fresh --seed

# Lihat routes
php artisan route:list

# Lihat database status
php artisan migrate:status
```

---

## 🐛 Troubleshooting

### Error: "No application encryption key has been specified"

```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000] [1045] Access denied"

Periksa konfigurasi database di `.env`:
- Pastikan username dan password benar
- Pastikan database sudah dibuat

### Error: "Class 'X' not found"

```bash
composer dump-autoload
```

### Storage Permission Error

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Logo Mitra Tidak Muncul

Pastikan folder `public/assets/mitra/logo/` ada dan berisi gambar logo.

---

## 📝 Fitur Per Role

### Admin
- Dashboard statistik
- Manajemen user (mahasiswa & mitra)
- Verifikasi mitra
- Manajemen lowongan kerja
- Manajemen pelatihan

### Mitra (Perusahaan)
- Dashboard mitra
- Posting lowongan kerja
- Edit/hapus lowongan
- Posting pelatihan
- Lihat pelamar
- Kelola profil perusahaan

### Mahasiswa
- Browse lowongan kerja
- Browse pelatihan
- Apply lowongan
- Daftar pelatihan
- Kelola profil

---

## 🌐 Routes Utama

```
GET  /                     - Home page
GET  /login                - Login page
POST /login                - Login process
POST /logout               - Logout
GET  /home                 - Home (authenticated)
GET  /loker                - List lowongan kerja
GET  /loker/{id}           - Detail lowongan
GET  /pelatihan            - List pelatihan
GET  /pelatihan/{id}       - Detail pelatihan
GET  /mitra/{id}           - Profil mitra
GET  /dashboard            - Dashboard (role-based redirect)
```

---

## 📞 Kontak & Support

Jika menemukan bug atau ada pertanyaan:
- Email: support@skillbridge.com
- GitHub Issues: [Link ke repository issues]

---

## 📄 License

This project is licensed under the MIT License.

---

## 👥 Contributors

- **Developer**: [Nama Anda]
- **Version**: 1.0.0
- **Last Update**: November 2025

---

## 🎉 Happy Coding!

Terima kasih telah menggunakan Skillbridge! 🚀
