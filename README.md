# Reservasi Ruang Rapat

## Sistem & Fitur Reservasi Ruang Rapat

### Fitur Utama
- ✅ Pendaftaran & login pengguna (authentication)
- ✅ Halaman dashboard untuk pengguna dan admin
- ✅ Manajemen ruangan (CRUD) untuk admin
- ✅ Pemesanan ruang oleh pengguna dengan tanggal/waktu
- ✅ Seeder admin untuk akun awal

### Tech Stack
- 🛠️ PHP (Laravel)
- 🗄️ MySQL / MariaDB (atau database lain yang didukung Laravel)
- 🎨 Tailwind CSS

### Persyaratan Sistem
- PHP 8.x
- Composer
- Node.js & npm
- Database (MySQL/MariaDB)

### Quick Start
1. **Salin file environment dan atur variabel:**
   - Salin `.env.example` menjadi `.env` dan sesuaikan `DB_*`

2. **Jalankan migrasi dan seeder:**
   ```bash
   php artisan migrate
   php artisan db:seed
   
   // atau
   
   php artisan migrate:fresh --seed
   ```
   - Seeder akan menjalankan `DatabaseSeeder` (lihat `database/seeders`) untuk membuat akun admin awal

3. **Jalankan server lokal:**
   ```bash
   php artisan serve
   ```
   - Atau gunakan Laragon / environment lokal lain

### Akun Default
**Admin:**
- Email: `admin@office.com`
- Password: `password`

**User:**
- Email: `user@office.com`
- Password: `password`

---

## Skema Database

```
========================================
  DATABASE SCHEMA – MEETING RESERVATION
========================================
```

### 1. USERS
**Fields:**
- `id` (bigint, PK, auto increment)
- `name` (string)
- `email` (string, unique)
- `email_verified_at` (timestamp, nullable)
- `password` (string)
- `role` (enum: 'admin', 'user', default 'user')
- `remember_token` (string, nullable)
- `created_at` (timestamp)
- `updated_at` (timestamp)

**Description:**  
Menyimpan data akun pengguna aplikasi. Admin memiliki akses penuh ke seluruh fitur, sedangkan user hanya dapat melakukan pemesanan ruang rapat.

### 2. ROOMS
**Fields:**
- `id` (bigint, PK)
- `name` (string)
- `capacity` (integer)
- `location` (string)
- `description` (text, nullable)
- `created_at` (timestamp)
- `updated_at` (timestamp)

**Description:**  
Menyimpan daftar ruang rapat yang tersedia untuk dipesan. Admin dapat menambah, edit, atau menghapus data ruang.

### 3. RESERVATIONS
**Fields:**
- `id` (bigint, PK)
- `user_id` (foreign key → users.id)
- `room_id` (foreign key → rooms.id)
- `date` (date)
- `start_time` (time)
- `end_time` (time)
- `status` (enum: 'active', 'cancelled')
- `created_at` (timestamp)
- `updated_at` (timestamp)

**Indexes:**
- `(room_id, date)`
- `(room_id, date, start_time, end_time)`

**Description:**  
Menyimpan data pemesanan ruang rapat oleh user. Sistem wajib mengecek bentrok jadwal (overlap) berdasarkan:
- room_id
- date
- start_time & end_time

Status dapat berubah menjadi "cancelled" jika user membatalkan reservasi.

### RELATIONSHIPS
```
USERS (1) —— (∞) RESERVATIONS
ROOMS (1) —— (∞) RESERVATIONS
```

**Penjelasan:**
- Satu user dapat membuat banyak reservasi
- Satu room dapat digunakan berkali-kali selama jadwal tidak bentrok

---

## Alur Logika Mencegah Konflik Jadwal

Untuk memastikan tidak terjadi **reservasi tumpang tindih**, backend menerapkan logika berikut ketika user membuat reservasi:

### **1. Cek Jam Kerja**
Reservasi hanya diperbolehkan pada jam kerja:
```
08:00 — 17:00
```
Jika *start* atau *end* berada di luar rentang tersebut → reservasi ditolak.

### **2. Cek Durasi**
- `start_time` harus < `end_time`
- Durasi minimal boleh 1 menit (opsional)

### **3. Cek Konflik Jadwal pada Ruangan**
Sebelum menyimpan ke database, jalankan query:
```sql
SELECT COUNT(*) FROM reservations
WHERE room_id = :room_id
AND (
    (start_time < :end_time AND end_time > :start_time)
);
```
Jika hasil > 0 → **Bentrok → reservasi ditolak.**

### Diagram Alur Sederhana:
```
User pilih ruangan & waktu
           │
           ▼
    Validasi jam kerja?
         │  └─ Tidak → Tolak
         ▼
    Validasi format & durasi?
         │  └─ Tidak → Tolak
         ▼
 Cek bentrok dengan reservasi lain?
         │  └─ Ya → Tolak
         ▼
       Simpan
         ▼
   Reservasi Berhasil
```

### Fitur Autentikasi & Akses
- Semua pengguna harus login
- Pengguna hanya bisa membatalkan reservasi mereka sendiri
- Admin (opsional) dapat melihat semua reservasi

---
