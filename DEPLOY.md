# Panduan Deploy ke Hostinger

## 1. Build Asset (WAJIB)
```bash
npm install
npm run build
```

## 2. Backup Database
```bash
mysqldump -u root -p web-taman-seminari > database.sql
```

## 3. Setup .env untuk Production
Copy `.env.example` ke `.env` lalu isi:
```
APP_URL=https://seminari.santomikael.com
APP_DEBUG=false
APP_KEY=           #kosong, nanti diisi php artisan key:generate

DB_DATABASE=nama_database
DB_USERNAME=user_database
DB_PASSWORD=password
```

## 4. Upload ke Hostinger (Cara Benar)
Hostinger tidak bisa直接用 symlink. Ikuti langkah ini:

**A.** Buat folder di `public_html` level atas, misal: `taman-seminari/`
**B.** Upload seluruh project ke `taman-seminari/` (include semua file)
**C.** Hapus folder `public_html/` isinya, lalu copy isi folder `taman-seminari/public/` ke `public_html/`
**D.** Edit `public_html/index.php` ubah path menjadi:
```php
require __DIR__.'/../taman-seminari/vendor/autoload.php';
$app = require_once __DIR__.'/../taman-seminari/bootstrap/app.php';
```
(Juga ubah `__DIR__.'/../storage/...'` jadi `__DIR__.'/../taman-seminari/storage/...'`)

**E.** Jalankan di terminal Hostinger (SSH/cPanel Terminal):
```bash
cd taman-seminari
php artisan key:generate
php artisan migrate
```

## 5. Selesai
Akses website di domain anda. Login admin di `/login`.

## 6. Biar Muncul di Google
- Daftar di **Google Search Console**: https://search.google.com/search-console
- Upload `sitemap.xml` yang sudah ada di public/
- Ganti `domain-anda.com` di `sitemap.xml` dengan domain asli

## Catatan Penting
✅ Gambar sudah bisa tampil (pakai route khusus, tidak perlu `storage:link`)
✅ SEO meta tags sudah terpasang (title, description, Open Graph)
✅ robots.txt sudah allow semua crawler
✅ `sitemap.xml` sudah tersedia
