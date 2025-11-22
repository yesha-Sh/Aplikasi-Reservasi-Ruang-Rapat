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

## Dokumentasi Cara Prompt

Dokumentasi ini menjelaskan bagaimana AI digunakan untuk menghasilkan proyek *Sistem Reservasi Ruang Rapat*.

### **Prompt 1 — Generate Full Project**
Prompt yang digunakan untuk menghasilkan struktur folder sebagai patokan dalam pengembangan aplikasi.

**PROMPT:**
```
Buatkan struktur folder lengkap beserta daftar file yang harus ada pada proyek **Laravel** (Blade manual, tanpa frontend framework lain), menggunakan database **MySQL**, dan desain **TailwindCSS**. Proyek ini adalah:
**"Sistem Reservasi Ruang Rapat"**
Gunakan perencanaan lengkap berikut sebagai dasar pembuatan struktur folder:

[Spesifikasi lengkap tentang role, alur sistem, validasi, database, dan desain UI...]

Berdasarkan semua spesifikasi di atas:
*Buatkan struktur folder paling ideal untuk Laravel
Tuliskan dalam format
* Folder tree
* Penjelasan singkat fungsi tiap folder/file
* Prioritas: rapi, scalable, mudah maintenance
Gunakan standar konvensi Laravel terbaru.
```

### **Prompt 2 — Generate Alur Logika**
Prompt ini digunakan untuk menghasilkan dokumen alur logika lengkap.

**PROMPT:**
```
Buatkan *alur logika backend* secara terstruktur dan sangat jelas untuk sistem **Reservasi Ruang Rapat**, dengan format deskriptif seperti dokumentasi teknis. Gunakan gaya penulisan seperti berikut:

* Penjelasan per langkah
* Block kode SQL untuk validasi bentrok
* Diagram alur ASCII seperti flowchart
* Bagian tambahan seperti autentikasi & akses

**Kriteria sistem:**
* Backend Laravel
* Database MySQL
* Validasi wajib:
  * Tidak boleh reservasi tumpang tindih (overlap)
  * Harus dalam jam kerja 08:00–17:00
  * start_time < end_time
  * Tidak boleh reservasi masa lalu
  * User hanya boleh membatalkan reservasinya sendiri
  * Admin opsional dapat melihat semua reservasi
```

### **Prompt 3 — Generate Frontend**
Prompt ini digunakan untuk menghasilkan template awal dari tampilan frontend.

**PROMPT:**
```
Buat seluruh kode frontend untuk proyek Laravel + Blade manual (tanpa framework frontend selain TailwindCSS dan sedikit JS minimal), mengikuti struktur folder yang sudah dirancang dan tema berikut:

Tema & estetika
Corporate × Minimalis × Futuristik dengan aksen merah tech. Banyak white space, font tegas, ikon tipis, kartu glossy/flat.

Palet warna (hex):
Primary Red: #D32F2F
Dark Red: #B71C1C
Soft Gray: #F4F4F4
Dark Graphite: #202124
Text Gray: #5F6368
```

### **Prompt 4 — Generate Backend**
Prompt ini digunakan untuk menghasilkan template awal dari backend.

**PROMPT:**
```
Buatkan seluruh controller dan modals backend Laravel untuk sistem Reservasi Ruang Rapat dengan fitur:
User: lihat ruang, lihat detail ruang, buat reservasi, batalkan reservasi sendiri, lihat riwayat.
Admin: CRUD ruang, kelola reservasi (lihat & batalkan siapa pun), kelola user (ubah role).
Validasi: jam kerja 08:00–17:00, tidak tumpang tindih (overlap), start < end, tidak masa lalu.
```

### **Ringkasan Output AI yang Dipakai**
- ✅ Skema database dan relasi tabel
- ✅ Alur logika deteksi konflik jadwal (Penjelasan validasi jam kerja dan pembatalan reservasi)
- ✅ Struktur folder
- ✅ Template frontend dasar (Blade + TailwindCSS)
- ✅ Template Controller dan modals

### **Penyesuaian Manual oleh Pengembang**
Meski AI menghasilkan seluruh kerangka proyek, saya melakukan penyesuaian manual pada bagian berikut:

- 🔧 Menjalankan migration dan memperbaiki error
- 🔧 Menyesuaikan environment backend (`.env`)
- 🔧 Memperbaiki beberapa endpoint yang tidak kompatibel
- 🔧 Menguji fungsi reservasi & pembatalan
- 🔧 Menyusun ulang file agar struktur proyek lebih rapi
- 🔧 Menyempurnakan tampilan frontend dan backend yang lebih rapih

### **Alasan Menggunakan AI Prompt Skala Besar**
Prompt skala besar digunakan agar proyek dapat selesai dalam waktu singkat sesuai ketentuan tugas *take-home assignment*. AI menghasilkan draft awal berupa struktur proyek lengkap, kemudian saya melakukan review, perbaikan, dan penyesuaian manual agar sistem dapat berjalan tanpa error.

Selain itu, terdapat keterbatasan di setiap AI dalam memberikan informasi atau bahkan membuat sesuatu, jadi untuk meminimalisir miss komunikasi dengan AI, saya merancang keseluruhan project dengan detail dan terstruktur.
