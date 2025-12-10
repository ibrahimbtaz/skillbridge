# 🎓 Skillbridge - Platform Pelatihan & Lowongan Kerja

Platform berbasis web yang menghubungkan mahasiswa dengan perusahaan mitra untuk pelatihan dan lowongan kerja.

## 📋 Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Teknologi](#teknologi)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Docker Installation](#docker-installation) ⬅️ **BARU**
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
- **Docker**: Docker & Docker Compose (opsional)

---

## 📦 Persyaratan Sistem

### Instalasi Manual
- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js & NPM (opsional, untuk asset compilation)
- Git

### Instalasi Docker
- Docker Desktop >= 20.10
- Docker Compose >= 2.0
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

## 🐳 Docker Installation

### Persyaratan Docker

Pastikan Docker Desktop sudah terinstall:
- **Windows/Mac**: [Download Docker Desktop](https://www.docker.com/products/docker-desktop)
- **Linux**: Install Docker Engine dan Docker Compose

### 1. Setup File Docker

Pastikan file berikut ada di root project:

```
skillbridge/
├── Dockerfile
├── docker-compose.yml
└── docker/
    └── nginx/
        └── default.conf
```

### 2. Konfigurasi Environment untuk Docker

Edit file `.env` dan sesuaikan untuk Docker:

```env
APP_NAME=Skillbridge
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db                    # ⬅️ Ganti dengan 'db' (nama service Docker)
DB_PORT=3306
DB_DATABASE=skillbridge
DB_USERNAME=laravel           # ⬅️ Ganti dengan 'laravel'
DB_PASSWORD=password          # ⬅️ Ganti dengan 'password'

# Konfigurasi MySQL dump dideteksi otomatis (tidak perlu diubah)
```

> **Note**: Tidak perlu file `.env.docker` terpisah. Konfigurasi backup MySQL otomatis menyesuaikan berdasarkan environment.

### 3. Build dan Jalankan Container

```bash
# Build dan jalankan semua container
docker-compose up -d --build

# Tunggu beberapa saat hingga semua container running
docker-compose ps
```

### 4. Setup Aplikasi di Container

Masuk ke container app dan jalankan setup:

```bash
# Masuk ke container
docker exec -it skillbridge-app bash

# Di dalam container, jalankan:
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan optimize

# Keluar dari container
exit
```

### 5. Akses Aplikasi

Setelah setup selesai, akses:

- **Laravel App**: http://localhost:8000
- **PhpMyAdmin**: http://localhost:8080
  - Server: `db`
  - Username: `laravel`
  - Password: `password`

### Docker Command Berguna

```bash
# Lihat status container
docker-compose ps

# Lihat logs semua service
docker-compose logs -f

# Lihat logs service tertentu
docker-compose logs -f app
docker-compose logs -f nginx
docker-compose logs -f db

# Restart container
docker-compose restart

# Stop container
docker-compose stop

# Start container yang sudah ada
docker-compose start

# Stop dan hapus container
docker-compose down

# Stop dan hapus container + volumes
docker-compose down -v

# Rebuild container tanpa cache
docker-compose build --no-cache
docker-compose up -d

# Masuk ke container tertentu
docker exec -it skillbridge-app bash
docker exec -it skillbridge-db bash
docker exec -it skillbridge-nginx sh

# Jalankan artisan command dari luar container
docker exec skillbridge-app php artisan migrate
docker exec skillbridge-app php artisan cache:clear
docker exec skillbridge-app php artisan db:seed
```

### Docker Compose Services

Project ini menggunakan 4 services:

| Service | Container Name | Port | Keterangan |
|---------|---------------|------|------------|
| **app** | skillbridge-app | 9000 | PHP-FPM 8.2 |
| **nginx** | skillbridge-nginx | 8000 | Web Server |
| **db** | skillbridge-db | 3307 | MySQL 8.0 |
| **phpmyadmin** | skillbridge-phpmyadmin | 8080 | Database Manager |

### Troubleshooting Docker

#### Port Sudah Digunakan

Jika port 8000 atau 3307 sudah digunakan, edit `docker-compose.yml`:

```yaml
nginx:
  ports:
    - "8001:80"  # Ganti 8000 dengan port lain

db:
  ports:
    - "3308:3306"  # Ganti 3307 dengan port lain
```

#### Container Gagal Start

```bash
# Cek logs error
docker-compose logs

# Hapus dan rebuild
docker-compose down -v
docker-compose up -d --build
```

#### Permission Error di Linux

```bash
# Berikan permission ke folder
sudo chown -R $USER:$USER .
sudo chmod -R 775 storage bootstrap/cache
```

#### Database Connection Error

Pastikan di `.env`:
- `DB_HOST=db` (bukan 127.0.0.1)
- `DB_USERNAME=laravel`
- `DB_PASSWORD=password`

Lalu restart container:

```bash
docker-compose restart app
```

---

## 🎯 Database Seeding

### Seed Data Default

**Manual Installation:**
```bash
php artisan db:seed
```

**Docker Installation:**
```bash
docker exec skillbridge-app php artisan db:seed
```

### Seed Spesifik

**Manual:**
```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=MahasiswaSeeder
php artisan db:seed --class=MitraSeeder
php artisan db:seed --class=LokerSeeder
php artisan db:seed --class=PelatihanSeeder
```

**Docker:**
```bash
docker exec skillbridge-app php artisan db:seed --class=UserSeeder
docker exec skillbridge-app php artisan db:seed --class=MahasiswaSeeder
docker exec skillbridge-app php artisan db:seed --class=MitraSeeder
docker exec skillbridge-app php artisan db:seed --class=LokerSeeder
docker exec skillbridge-app php artisan db:seed --class=PelatihanSeeder
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
├── docker/
│   └── nginx/
│       └── default.conf
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
├── Dockerfile
├── docker-compose.yml
├── .dockerignore
├── .env
├── .env.example
├── composer.json
└── artisan
```

---

## 🔧 Command Artisan Berguna

### Manual Installation

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

### Docker Installation

```bash
# Clear cache
docker exec skillbridge-app php artisan cache:clear
docker exec skillbridge-app php artisan config:clear
docker exec skillbridge-app php artisan route:clear
docker exec skillbridge-app php artisan view:clear

# Optimize untuk production
docker exec skillbridge-app php artisan optimize

# Rollback migration
docker exec skillbridge-app php artisan migrate:rollback

# Fresh migration dengan seeding
docker exec skillbridge-app php artisan migrate:fresh --seed

# Lihat routes
docker exec skillbridge-app php artisan route:list

# Lihat database status
docker exec skillbridge-app php artisan migrate:status
```

---

## 💾 Backup Database

Skillbridge menggunakan [Spatie Laravel Backup](https://spatie.be/docs/laravel-backup/) untuk backup database. Konfigurasi dump MySQL/MariaDB **dideteksi otomatis** berdasarkan environment (Docker atau lokal).

### Menjalankan Backup

**Manual Installation:**
```bash
php artisan backup:run --only-db --disable-notifications
```

**Docker Installation:**
```bash
docker-compose exec app php artisan backup:run --only-db --disable-notifications
```

### Lokasi File Backup

File backup tersimpan di folder `storage/app/backups/` dalam format ZIP.

### Auto-Detection

Sistem secara otomatis mendeteksi:
- **Docker**: Menggunakan `--skip-ssl` (MariaDB client)
- **Windows/Laragon**: Menggunakan `--set-gtid-purged=OFF` dan path MySQL dari Laragon

Tidak perlu konfigurasi manual di file `.env`.

---

## 🐛 Troubleshooting

### Error: "No application encryption key has been specified"

**Manual:**
```bash
php artisan key:generate
```

**Docker:**
```bash
docker exec skillbridge-app php artisan key:generate
```

### Error: "SQLSTATE[HY000] [1045] Access denied"

Periksa konfigurasi database di `.env`:
- Pastikan username dan password benar
- Pastikan database sudah dibuat
- **Untuk Docker**: Pastikan `DB_HOST=db` bukan `127.0.0.1`

### Error: "Class 'X' not found"

**Manual:**
```bash
composer dump-autoload
```

**Docker:**
```bash
docker exec skillbridge-app composer dump-autoload
```

### Storage Permission Error

**Manual:**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

**Docker (Linux):**
```bash
sudo chown -R $USER:$USER storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Logo Mitra Tidak Muncul

Pastikan folder `public/assets/mitra/logo/` ada dan berisi gambar logo.

### Docker Container Tidak Bisa Start

```bash
# Stop semua container
docker-compose down

# Hapus volumes
docker-compose down -v

# Rebuild dan start
docker-compose up -d --build
```

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
