# Panduan Deployment Priangan TV

## Masalah: CSS dan JS Tidak Terpanggil di Hosting

### Penyebab Umum
1. ❌ Asset Vite belum di-build untuk production
2. ❌ APP_URL tidak sesuai dengan domain hosting
3. ❌ Symbolic link storage belum dibuat
4. ❌ Permission folder tidak tepat
5. ❌ File .env tidak dikonfigurasi dengan benar

---

## ✅ Langkah-Langkah Deployment

### 1. Build Asset untuk Production

**PENTING:** Sebelum upload ke hosting, jalankan perintah ini di local:

```bash
npm install
npm run build
```

Perintah ini akan membuat folder `public/build` yang berisi file CSS dan JS yang sudah dioptimasi.

**Pastikan folder `public/build` ter-upload ke hosting!**

---

### 2. Konfigurasi File .env di Hosting

Setelah upload, edit file `.env` di hosting dan sesuaikan:

```env
APP_NAME="Priangan TV"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com  # ⚠️ GANTI dengan domain hosting Anda

# Database (sesuaikan dengan hosting)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_database_anda
DB_PASSWORD=password_database_anda

# Session & Cache
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync

# Filesystem
FILESYSTEM_DISK=public
```

**⚠️ PENTING:**
- Ubah `APP_ENV` menjadi `production`
- Ubah `APP_DEBUG` menjadi `false`
- Sesuaikan `APP_URL` dengan domain hosting Anda (termasuk https://)
- Konfigurasi database sesuai dengan hosting

---

### 3. Generate Application Key

Jika belum ada APP_KEY di file .env, jalankan via SSH atau terminal hosting:

```bash
php artisan key:generate
```

---

### 4. Buat Symbolic Link untuk Storage

Jalankan perintah ini di hosting (via SSH atau File Manager):

```bash
php artisan storage:link
```

Perintah ini membuat symbolic link dari `public/storage` ke `storage/app/public` agar gambar dapat diakses.

**Jika tidak bisa via SSH**, buat symbolic link manual:
- Buat folder `storage` di dalam folder `public`
- Arahkan ke folder `storage/app/public`

---

### 5. Set Permission Folder

Pastikan permission folder berikut:

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public
```

Atau via cPanel File Manager:
- Folder `storage` dan `bootstrap/cache`: **755** atau **775**
- File di dalamnya: **644**

---

### 6. Clear Cache (Jika Diperlukan)

Jika ada masalah setelah deployment, clear cache:

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

Kemudian cache ulang untuk performa:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

### 7. Struktur Folder di Hosting

Pastikan struktur folder seperti ini:

```
public_html/ (atau htdocs/)
├── .htaccess
├── index.php
├── build/          ← Folder hasil npm run build (PENTING!)
│   ├── assets/
│   └── manifest.json
├── images/
│   └── logopriangantv.png
├── storage/        ← Symbolic link ke ../storage/app/public
└── faviconremove.png
```

**Folder Laravel lainnya** (app, config, routes, dll) sebaiknya di luar `public_html` untuk keamanan.

---

## 🔍 Troubleshooting

### CSS/JS Masih Tidak Muncul?

1. **Cek di Browser Console (F12)**
   - Lihat apakah ada error 404 untuk file CSS/JS
   - Perhatikan URL yang diminta

2. **Pastikan APP_URL Benar**
   ```env
   APP_URL=https://domain-anda.com  # Harus sama dengan domain hosting
   ```

3. **Cek Folder public/build Ada**
   - Pastikan folder `public/build` ter-upload
   - Cek isi folder `public/build/assets/`

4. **Clear Browser Cache**
   - Tekan Ctrl + Shift + R (hard refresh)
   - Atau buka di mode incognito

5. **Cek File .htaccess**
   - Pastikan file `.htaccess` ada di folder `public`
   - Pastikan mod_rewrite aktif di hosting

6. **Periksa Error Log**
   - Cek `storage/logs/laravel.log`
   - Atau error log di cPanel

---

## 📋 Checklist Deployment

Sebelum upload ke hosting, pastikan:

- [ ] Sudah menjalankan `npm run build`
- [ ] Folder `public/build` sudah ada dan berisi file
- [ ] File `.env` sudah dikonfigurasi untuk production
- [ ] APP_URL sudah sesuai dengan domain hosting
- [ ] Database sudah dikonfigurasi
- [ ] File `.htaccess` ada di folder public
- [ ] Sudah menjalankan `php artisan storage:link`
- [ ] Permission folder sudah benar (755 untuk folder, 644 untuk file)
- [ ] Sudah clear cache jika diperlukan

---

## 🚀 Optimasi Production

Untuk performa lebih baik:

```bash
# Cache konfigurasi
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimasi autoload
composer install --optimize-autoloader --no-dev
```

---

## 📞 Bantuan Lebih Lanjut

Jika masih ada masalah:
1. Cek error di `storage/logs/laravel.log`
2. Cek error log di hosting panel
3. Pastikan versi PHP di hosting minimal 8.1
4. Pastikan extension PHP yang dibutuhkan sudah aktif (mbstring, openssl, pdo, tokenizer, xml, ctype, json)

---

**Catatan:** Panduan ini dibuat khusus untuk project Priangan TV yang menggunakan Laravel 11 dengan Vite.
