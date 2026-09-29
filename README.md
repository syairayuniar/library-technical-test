# Sistem Peminjaman Buku Perpustakaan

Aplikasi sederhana untuk mengelola peminjaman buku perpustakaan dengan dua peran pengguna: **Admin** dan **Peminjam**. Dibuat sebagai bagian dari Technical Test Aptitude Test Universitas Gunadarma.

## Fitur

### Admin
- Kelola data buku: tambah, edit, hapus, lihat stok & kategori
- Proteksi hapus buku yang masih memiliki peminjaman aktif
- Melihat seluruh transaksi peminjaman yang sedang berjalan
- Dashboard ringkasan (total buku, total stok, peminjaman aktif)

### Peminjam
- Registrasi otomatis mendapat role `peminjam`
- Melihat daftar buku beserta stok
- Live search buku (AJAX, tanpa reload halaman)
- Meminjam buku (stok otomatis berkurang, ditolak jika stok habis)
- Mengembalikan buku (stok otomatis bertambah, status diperbarui)
- Melihat riwayat peminjaman miliknya sendiri (tidak bisa melihat milik peminjam lain)

### Keamanan
- Pembatasan akses admin/peminjam diterapkan di **middleware** (backend), bukan hanya UI
- Percobaan akses halaman admin oleh peminjam lewat URL langsung ditolak (403)
- Pengecekan stok dilakukan di UI **dan** backend — request manual ke endpoint pinjam tetap ditolak jika stok habis
- Validasi input dilakukan di server-side (Form Request), tidak hanya JavaScript

## Teknologi

- Laravel 12
- Blade (layout & component, tanpa duplikasi HTML)
- MySQL
- Laravel Breeze (autentikasi)
- JavaScript (`fetch()`) untuk live search AJAX
- Tailwind CSS

## Instalasi

1. Clone repository:
```bash
   git clone <url-repo-ini>
   cd perpustakaan
```

2. Install dependency PHP:
```bash
   composer install
```

3. Install dependency JavaScript:
```bash
   npm install
```

4. Salin file environment dan generate application key:
```bash
   cp .env.example .env
   php artisan key:generate
```

5. Buat database kosong di MySQL, lalu sesuaikan konfigurasi di `.env`:
```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=perpustakaan_db
   DB_USERNAME=root
   DB_PASSWORD=
```

6. Jalankan migration:
```bash
   php artisan migrate
```

7. Jalankan seeder (membuat akun admin, kategori, dan beberapa buku contoh):
```bash
   php artisan db:seed
```

8. Build asset frontend:
```bash
   npm run build
```

9. Jalankan server:
```bash
   php artisan serve
```

10. Buka `http://127.0.0.1:8000` di browser.

## Akun Demo

| Role     | Email                                    | Password |
|----------|------------------------------------------|----------|
| Admin    | admin@perpustakaan.test                  | password |
| Peminjam | Daftar sendiri lewat halaman `/register` |    -     |

Akun admin dibuat otomatis lewat `AdminSeeder`, **bukan** ditulis langsung di migration.

## Struktur Role & Middleware

- Semua user baru yang mendaftar otomatis mendapat `role = peminjam`.
- Middleware `admin` (`app/Http/Middleware/EnsureUserIsAdmin.php`) membatasi semua route di bawah prefix `/admin`, memastikan hanya user dengan `role = admin` yang bisa mengakses — termasuk saat diakses langsung lewat URL.
- Kepemilikan data peminjaman (riwayat & pengembalian) diverifikasi di level controller (`user_id` yang sedang login harus cocok), bukan hanya disaring di tampilan.

## Cara Testing Singkat

1. Register akun baru → cek role otomatis `peminjam`.
2. Login sebagai peminjam, coba buka `/admin/books` langsung dari address bar → harus muncul 403.
3. Pinjam buku dengan stok > 0 → stok berkurang. Buku dengan stok 0 → tombol pinjam nonaktif, dan request manual ke endpoint pinjam tetap ditolak (422).
4. Kembalikan buku yang dipinjam → stok bertambah, status berubah.
5. Buka `/my-borrowings` dengan 2 akun peminjam berbeda → riwayat masing-masing tidak tercampur.
6. Ketik di kolom pencarian `/books` → hasil berubah tanpa reload halaman.
(saya menambahkan menu berbentuk card jadi tidak perlu mengetik manual untuk pindah antar pages).

## Kendala yang Ditemui

- Beberapa kali salah penulisan rule validasi (`exist` vs `exists`) yang sempat menyebabkan error 500 saat submit form buku — sudah diperbaiki dengan pengecekan ulang di `StoreBookRequest`.
- Sempat lupa menambahkan `use` statement untuk relasi (`BelongsTo`) dan controller di `routes/web.php`, menyebabkan error class not found — sudah diperbaiki.
- Perlu menambahkan `casts()` untuk kolom `borrowed_at` dan `returned_at` di model `Borrowing` agar bisa diformat sebagai tanggal di tampilan.
- Sempat mencoba migrasi dari Tailwind ke CSS custom, namun dibatalkan (rollback via Git) karena menimbulkan beberapa error konflik komponen; project kembali menggunakan Tailwind bawaan Breeze.