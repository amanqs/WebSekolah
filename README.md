# White-Label School CMS (Turnkey CMS Sekolah) - Laravel 11 & Filament v3

Sistem Manajemen Sekolah & Portal Web Publik siap pakai (*turnkey/terima jadi*) yang dirancang khusus untuk seluruh jenjang sekolah di Indonesia (SD/MI, SMP/MTs, SMA/MA, SMK, dan SLB). 

Administrator sekolah dapat mengustomisasi **seluruh elemen visual, identitas sekolah, palet warna, navigasi menu, dan konten beranda langsung dari Filament PHP Admin Panel tanpa menyentuh satu baris kode Blade pun**.

---

## 🚀 Fitur Unggulan

### 1. Panel Pengaturan Sekolah Dinamis (Filament v3)
- **Identitas & Branding:** Nama Sekolah, NPSN, Jenjang, Tagline, Logo Utama (Light Mode), Logo Dark Mode, Favicon, serta Foto & Teks Sambutan Kepala Sekolah.
- **Color Palette Picker Interaktif:** Pemilih warna *Primary*, *Secondary*, dan *Accent* yang langsung disuntikkan ke variabel CSS Tailwind (`--color-primary`, `--color-secondary`, `--color-accent`) di frontend.
- **Dynamic Header & Footer Menu Builder:** Kelola struktur navigasi multi-level (dropdown induk-anak), urutan tampilan, dan target tautan tab baru/lama secara visual.
- **Sakelar Seksi Beranda (Homepage Section Toggles):** Aktifkan atau nonaktifkan seksi beranda dengan sekali klik (Hero Slider, Sambutan, Statistik, Berita, Ekstrakurikuler, Galeri, Testimoni, FAQ).
- **Kontak & Media Sosial:** Alamat, telepon kantor, integrasi pesan cepat WhatsApp resmi, email, kode embed Google Maps, dan tautan akun media sosial (FB, IG, YouTube, TikTok).

### 2. Portal Publik Modern & Responsif
- **Frontend Reactive Stack:** Laravel Blade + Livewire v3 + Tailwind CSS + Alpine.js.
- **Hero Slider Dinamis:** Slider gambar beranda dengan tombol aksi ganda (CTA: *Call To Action*).
- **Direktori Guru & Tenaga Kependidikan:** Pencarian dan penyaringan data pendidik berdasarkan jabatan dan mata pelajaran.
- **Warta & Pengumuman Sekolah:** Berita berkategori, sistem tag, pencacah jumlah pembaca (*view counter*), tombol bagikan instan (WhatsApp, FB, Twitter/X), dan optimasi SEO Meta otomatis.
- **Agenda / Kalender Kegiatan:** Jadwal kegiatan sekolah mendatang.
- **Pusat Unduhan & Pustaka Digital:** Unduh formulir administrasi, silabus, surat edaran, dan modul pembelajaran (PDF) langsung dengan pelacak jumlah unduhan.
- **Galeri Foto & Embed Video YouTube:** Album dokumentasi kegiatan sekolah.

### 3. Modul Khusus Sekolah
1. **PPDB Online (Penerimaan Peserta Didik Baru):**
   - Sakelar buka/tutup pendaftaran langsung dari admin panel.
   - Formulir pendaftaran multi-step interaktif (Data Diri, Data Orang Tua, Sekolah Asal & Peminatan, Unggah Berkas PDF/JPG, dan Ringkasan Pernyataan).
   - Penomoran registrasi unik otomatis (contoh: `PPDB-2026-0001`).
   - Fitur cetak **Kartu Pendaftaran Resmi (PDF)** menggunakan *DomPDF* lengkap dengan kop sekolah, foto siswa, dan verifikasi.
   - Panel Verifikator PPDB (Filament): Tinjau berkas pendaftar, ubah status (*Menunggu Verifikasi*, *Terverifikasi*, *Diterima / Lolos*, *Tidak Lolos*), dan **Ekspor Seluruh Data ke Excel (.xlsx)** via *Maatwebsite Excel*.
2. **Portal Pengumuman Kelulusan / Cek NISN:**
   - Jam hitung mundur interaktif (*countdown timer*) yang mengunci formulir pencarian hingga waktu rilis pengumuman tiba.
   - Pengecekan status instan berbasis NISN dan tanggal lahir.
   - Kartu status kelulusan dinamis (*LULUS*, *TIDAK LULUS*, *DITUNDA*) lengkap dengan nilai rata-rata dan catatan resmi kepala sekolah.

---

## 🛠️ Tech Stack & Paket Rekomendasi

- **Framework:** Laravel 11 (PHP 8.2+)
- **Admin Panel:** Filament PHP v3
- **Frontend:** Laravel Blade, Livewire v3, Tailwind CSS, Alpine.js
- **Database:** MySQL / MariaDB / PostgreSQL
- **Paket Composer:**
  - `filament/filament: ^3.2`
  - `livewire/livewire: ^3.4`
  - `spatie/laravel-permission: ^6.4` (RBAC: Super Admin, Admin Web, Admin PPDB)
  - `spatie/laravel-settings: ^3.3` (Dynamic School Settings engine)
  - `spatie/laravel-medialibrary: ^11.4` (Media & image conversions)
  - `barryvdh/laravel-dompdf: ^3.0` (PDF Card generator)
  - `maatwebsite/excel: ^3.1` (Excel export)

---

## 💻 Panduan Instalasi & Menjalankan Aplikasi

### 1. Kebutuhan Sistem
Pastikan komputer server atau lokal Anda telah terpasang:
- PHP >= 8.2 (dengan ekstensi `pdo_mysql`, `mbstring`, `openssl`, `gd`, `intl`, `zip`)
- Composer >= 2.x
- Node.js & NPM (opsional jika ingin build aset frontend dari sumber)
- MySQL / MariaDB

### 2. Perintah Instalasi Dependensi
Jalankan perintah berikut di direktori proyek:

```bash
# 1. Install seluruh paket PHP via Composer
composer install

# 2. Salin environment file dan buat Application Key
cp .env.example .env
php artisan key:generate

# 3. Konfigurasikan koneksi database di file .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=db_sekolah
# DB_USERNAME=root
# DB_PASSWORD=

# 4. Jalankan migrasi database & buat tabel pengaturan Spatie
php artisan migrate

# 5. Jalankan Seeder untuk data awal sekolah lengkap
php artisan db:seed

# 6. Buat symbolic link untuk direktori penyimpanan upload publik
php artisan storage:link

# 7. (Opsional) Install dan build aset frontend
npm install
npm run build
```

---

## 🐘 Panduan Khusus Pengguna Laragon

Proyek ini telah dikonfigurasi dan diintegrasikan langsung dengan instalasi **Laragon** di komputer Anda (`C:\laragon`):
- Direktori proyek di `D:\WebsiteSekolah` telah ditautkan (*junction link*) ke folder web Laragon: `C:\laragon\www\WebsiteSekolah`.
- Basis data MySQL **`db_sekolah`** telah otomatis dibuat, seluruh migrasi tabel telah dijalankan, dan data seeder awal telah terisi.
- Ekstensi PHP yang dibutuhkan (`pdo_mysql`, `zip`, `intl`, `gd`, `fileinfo`) telah diaktifkan di PHP 8.3 Laragon.

### Cara Membuka Website di Laragon:
1. Pastikan tombol **Start All** di Laragon aktif (Apache & MySQL berstatus *running*).
2. Anda dapat langsung membuka website melalui browser di salah satu URL berikut:
   - **Frontend Portal:** 👉 [`http://localhost/WebsiteSekolah/public`](http://localhost/WebsiteSekolah/public)
   - **Filament Admin Panel:** 👉 [`http://localhost/WebsiteSekolah/public/admin`](http://localhost/WebsiteSekolah/public/admin)
3. *(Opsional - Pretty URL Laragon)*:
   - Klik kanan pada aplikasi Laragon -> **Apache** -> **Reload**.
   - Laragon akan mendeteksi virtual host dan Anda dapat mengaksesnya via 👉 `http://websitesekolah.test` atau `http://WebsiteSekolah.test`.

---

## 🔐 Akun Default Admin Panel

Setelah menjalankan `php artisan db:seed`, buka browser di alamat:
👉 **`http://localhost:8000/admin`**

- **Super Admin:**
  - Email: `admin@sekolah.sch.id`
  - Password: `password`
- **Panitia PPDB:**
  - Email: `ppdb@sekolah.sch.id`
  - Password: `password`

---

## 🎨 Arsitektur Dynamic White-Label & Color Injections

Perubahan warna tema di Filament Admin disuntikkan secara dinamis pada `resources/views/layouts/app.blade.php`:

```html
<style>
    :root {
        --color-primary: {{ $settings->primary_color ?? '#1e40af' }};
        --color-secondary: {{ $settings->secondary_color ?? '#059669' }};
        --color-accent: {{ $settings->accent_color ?? '#f59e0b' }};
    }
</style>
```

Sehingga kelas Tailwind CSS seperti `bg-primary`, `text-primary`, `hover:bg-primary-dark`, `bg-secondary`, dan `text-accent` akan langsung merefleksikan identitas warna sekolah tanpa perlu melakukan *re-compile* file CSS!

