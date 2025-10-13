# Struktur Frontend & Backend - Priangan TV

## 📌 Halaman Frontend (Publik - Tanpa Login)

Halaman-halaman ini dapat diakses oleh siapa saja tanpa perlu login:

### 1. **Halaman Beranda** 
- **URL**: `/` atau `http://localhost:8000/`
- **Route**: `Route::get('/', [WelcomeController::class, 'index'])`
- **Controller**: `WelcomeController@index`
- **View**: `resources/views/welcome.blade.php`
- **Fungsi**: Menampilkan konten terbaru (8 konten teratas)

### 2. **Halaman Advertorial**
- **URL**: `/advertorial` atau `http://localhost:8000/advertorial`
- **Route**: `Route::get('/advertorial', [AdvertorialController::class, 'index'])`
- **Controller**: `AdvertorialController@index`
- **View**: `resources/views/advertorial.blade.php`
- **Fungsi**: Menampilkan daftar advertorial dengan pagination

### 3. **Halaman Layanan Kami**
- **URL**: `/layanan-kami` atau `http://localhost:8000/layanan-kami`
- **Route**: `Route::get('/layanan-kami', [LayananKamiController::class, 'index'])`
- **Controller**: `LayananKamiController@index`
- **View**: `resources/views/layanan-kami.blade.php`
- **Fungsi**: Menampilkan informasi layanan yang ditawarkan

---

## 🔒 Halaman Backend (Perlu Login)

Halaman-halaman ini **HANYA** dapat diakses setelah login:

### 1. **Dashboard Admin**
- **URL**: `/dashboard`
- **Middleware**: `auth`, `verified`
- **Controller**: `DashboardController@index`
- **Fungsi**: Menampilkan statistik dan grafik konten

### 2. **Manajemen Konten (CRUD)**
- **URL**: `/konten` (index, create, edit, update, delete)
- **Middleware**: `auth`
- **Controller**: `KontenController`
- **Fungsi**: Menambah, mengedit, menghapus konten yang ditampilkan di frontend

### 3. **Profile Management**
- **URL**: `/profile`
- **Middleware**: `auth`
- **Controller**: `ProfileController`
- **Fungsi**: Mengelola profil user yang login

---

## 🔑 Cara Kerja

### Frontend (Pengunjung Umum)
1. Pengunjung membuka website
2. Langsung dapat melihat semua halaman (Beranda, Advertorial, Layanan Kami)
3. **TIDAK PERLU LOGIN** untuk melihat konten

### Backend (Admin/Editor)
1. Admin login melalui `/login`
2. Setelah login, dapat mengakses `/dashboard`
3. Dapat mengelola konten melalui `/konten`
4. Konten yang ditambahkan akan **otomatis muncul** di halaman frontend

---

## 📝 Alur Data

```
Admin Login → Dashboard → Tambah/Edit Konten → Konten tersimpan di database
                                                         ↓
                                    Frontend (Publik) ← Database ← Konten ditampilkan
```

---

## ⚙️ File Penting

### Routes
- **File**: `routes/web.php`
- **Public Routes**: Baris 19-26 (tanpa middleware)
- **Protected Routes**: Baris 37-49 (dengan middleware auth)

### Controllers
- **Frontend**: `WelcomeController`, `AdvertorialController`, `LayananKamiController`
- **Backend**: `DashboardController`, `KontenController`, `ProfileController`

### Views
- **Frontend**: `welcome.blade.php`, `advertorial.blade.php`, `layanan-kami.blade.php`
- **Backend**: `page/dashboard/`, `page/konten/`

---

## ✅ Kesimpulan

✔️ **Frontend sudah dapat diakses tanpa login**  
✔️ **Backend tetap terlindungi dengan middleware auth**  
✔️ **Struktur route sudah terorganisir dengan baik**  
✔️ **Semua halaman publik tidak memiliki middleware auth**
