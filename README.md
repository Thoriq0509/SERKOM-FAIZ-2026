# Sistem Manajemen Profil Sekolah

Aplikasi profil sekolah berbasis web yang dibangun menggunakan framework Laravel 13. Aplikasi ini menyajikan informasi sekolah secara publik (profil, guru, siswa, ekstrakurikuler, berita, dan galeri) serta dilengkapi dengan dashboard admin untuk pengelolaan konten.

---

## Daftar Isi

- [Fitur](#fitur)
- [Teknologi](#teknologi)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Akun Default](#akun-default)
- [Struktur Folder](#struktur-folder)
- [Hak Akses Pengguna](#hak-akses-pengguna)
- [Author](#author)

---

## Fitur

### Publik (Tanpa Login)

- Beranda dengan hero carousel dan sambutan Kepala Sekolah
- Profil sekolah, sejarah, visi, dan misi
- Daftar guru beserta detail
- Daftar siswa
- Daftar ekstrakurikuler beserta detail
- Berita sekolah beserta detail
- Galeri foto dan video (mendukung link YouTube)
- Tautan media sosial sekolah (Facebook, Instagram, WhatsApp)

### Dashboard Admin & Operator

- Login dan logout dengan sistem autentikasi
- Dashboard dengan statistik data
- Kelola profil sekolah (nama, NPSN, alamat, kontak, visi, misi, sambutan, media sosial)
- Kelola data pengelola (khusus Admin)
- Kelola data guru (khusus Admin)
- Kelola data siswa (khusus Admin)
- Kelola ekstrakurikuler
- Kelola berita (dengan slug otomatis)
- Kelola galeri foto dan video

---

## Teknologi

- **Backend:** Laravel 13 (PHP 8.x)
- **Database:** MySQL / MariaDB
- **Frontend:** Bootstrap 5, HTML, CSS, JavaScript
- **Template Admin:** Admin Dashboard Kit (dikustomisasi)
- **Library Tambahan:** Font Awesome, AOS, GLightbox, DataTables
- **Font:** Montserrat
- **Version Control:** Git

---

## Persyaratan Sistem

- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Node.js & NPM (opsional)
- Web server (Apache / Nginx / `php artisan serve`)

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/profil-sekolah.git
cd profil-sekolah
```

### 2. Install Dependency

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

### 5. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_school_profile
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Jalankan Migration & Seeder

```bash
php artisan migrate --seed
```

### 7. Buat Symlink Storage

```bash
php artisan storage:link
```

### 8. Jalankan Server

```bash
php artisan serve
```

### 9. Buka di Browser

```
http://127.0.0.1:8000
```

---

## Akun Default

| Role     | Username | Password |
|----------|----------|----------|
| Admin    | admin    | password |
| Operator | operator | password |

> **Catatan:** Segera ganti password setelah login pertama kali demi keamanan.

---

## Struktur Folder

```
profil-sekolah/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── LandingPageController.php
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── UserController.php
│   │   │       ├── TeacherController.php
│   │   │       ├── StudentController.php
│   │   │       ├── SchoolProfileController.php
│   │   │       ├── NewsController.php
│   │   │       ├── ExtracurricularController.php
│   │   │       └── GalleryController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── SchoolProfile.php
│       ├── Teacher.php
│       ├── Student.php
│       ├── News.php
│       ├── Gallery.php
│       └── Extracurricular.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── landing/
│       ├── admin/
│       ├── auth/
│       └── layouts/
├── routes/
│   └── web.php
├── public/
│   └── assets/
│       ├── admin/
│       ├── landing/
│       ├── datatables/
│       └── fontawesome/
└── README.md
```

---

## Hak Akses Pengguna

| Fitur                    | Publik | Operator | Admin |
|--------------------------|:------:|:--------:|:-----:|
| Melihat halaman publik   |   ✅   |    ✅    |  ✅   |
| Login / Logout           |   ❌   |    ✅    |  ✅   |
| Melihat Dashboard        |   ❌   |    ✅    |  ✅   |
| Kelola Profil Sekolah    |   ❌   |    ✅    |  ✅   |
| Kelola Ekstrakurikuler   |   ❌   |    ✅    |  ✅   |
| Kelola Berita            |   ❌   |    ✅    |  ✅   |
| Kelola Galeri            |   ❌   |    ✅    |  ✅   |
| Kelola Data Pengelola    |   ❌   |    ❌    |  ✅   |
| Kelola Data Guru         |   ❌   |    ❌    |  ✅   |
| Kelola Data Siswa        |   ❌   |    ❌    |  ✅   |

---

## Author

**Faiz At Thoriq**

- Sekolah: SMK YPC Tasikmalaya
- Jurusan: Pengembangan Perangkat Lunak dan Gim (PPLG)
- Konsentrasi Keahlian: Rekayasa Perangkat Lunak (RPL)
- Tahun Ajaran: 2026/2027

---

## Lisensi

Project ini dibuat untuk keperluan tugas sekolah (Uji Sertifikasi Kompetensi / LSP). Dilarang memperjualbelikan tanpa izin pembuat.