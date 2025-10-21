<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class KontenController extends Controller
{
    /**
     * Menampilkan daftar konten dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        try {
            $query = Konten::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                        ->orWhere('caption', 'like', "%{$search}%");
                });
            }

            $konten = $query->orderBy('tanggal', 'desc')
                ->orderBy('id', 'desc')
                ->paginate(8)
                ->withQueryString();

            return view('page.konten.index', [
                'konten' => $konten,
            ]);
        } catch (\Exception $e) {
            Log::error('Error saat memuat konten: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat data konten.');
        }
    }

    /**
     * Menyimpan konten baru ke database dengan validasi lengkap.
     */
    public function store(Request $request)
    {
        // --- PERBAIKAN UTAMA ADA DI SINI ---
        $validatedData = $request->validate([
            'judul'   => 'required|string|max:255',
            'caption' => 'required|string',
            'tanggal' => 'required|date',
            'gambar'  => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:5120', // Batas maksimal 5MB (akan dikompres ke WebP)
                // Validasi kustom untuk hanya menerima gambar landscape
                function (string $attribute, UploadedFile $value, \Closure $fail) {
                    $imageSize = getimagesize($value->getRealPath());
                    $width = $imageSize[0];
                    $height = $imageSize[1];

                    // Validasi landscape: lebar harus lebih besar dari tinggi
                    if ($width <= $height) {
                        $fail('Gambar harus berukuran landscape (lebar lebih besar dari tinggi).');
                    }
                },
            ],
        ]);

        // Membersihkan input caption dari HTML berbahaya
        $validatedData['caption'] = clean($request->input('caption'));

        if ($request->hasFile('gambar')) {
            $path = $this->convertToWebP($request->file('gambar'), 'konten');
            $validatedData['gambar'] = $path;
        }

        Konten::create($validatedData);

        return redirect()->route('konten.index')->with('success', 'Konten berhasil ditambahkan.');
    }

    /**
     * Memperbarui konten yang ada di database.
     */
    public function update(Request $request, Konten $konten)
    {
        $validatedData = $request->validate([
            'judul'   => 'required|string|max:255',
            'caption' => 'required|string',
            'tanggal' => 'required|date',
            'gambar'  => [
                'nullable', // Gambar opsional saat update
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:5120', // Batas maksimal 5MB (akan dikompres ke WebP)
                function (string $attribute, UploadedFile $value, \Closure $fail) {
                    $imageSize = getimagesize($value->getRealPath());
                    $width = $imageSize[0];
                    $height = $imageSize[1];

                    // Validasi landscape: lebar harus lebih besar dari tinggi
                    if ($width <= $height) {
                        $fail('Gambar harus berukuran landscape (lebar lebih besar dari tinggi).');
                    }
                },
            ],
        ]);

        $validatedData['caption'] = clean($request->input('caption'));

        if ($request->hasFile('gambar')) {
            if ($konten->gambar && Storage::disk('public')->exists($konten->gambar)) {
                Storage::disk('public')->delete($konten->gambar);
            }

            $path = $this->convertToWebP($request->file('gambar'), 'konten');
            $validatedData['gambar'] = $path;
        }

        $konten->update($validatedData);

        return redirect()->route('konten.index')->with('success', 'Konten berhasil diperbarui!');
    }

    /**
     * Menghapus konten dari database.
     */
    public function destroy(Konten $konten)
    {
        try {
            if ($konten->gambar && Storage::disk('public')->exists($konten->gambar)) {
                Storage::disk('public')->delete($konten->gambar);
            }

            $konten->delete();
            return redirect()->route('konten.index')->with('success', 'Konten berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error saat menghapus konten: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus konten.');
        }
    }

    /**
     * Konversi gambar yang diupload ke format WebP
     * 
     * @param UploadedFile $file
     * @param string $directory
     * @return string Path file yang disimpan
     */
    private function convertToWebP(UploadedFile $file, string $directory): string
    {
        // Generate nama file unik dengan ekstensi .webp
        $filename = Str::random(40) . '.webp';
        $path = $directory . '/' . $filename;
        
        // Buat direktori jika belum ada
        $fullPath = storage_path('app/public/' . $directory);
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }
        
        // Inisialisasi ImageManager dengan GD driver
        $manager = new ImageManager(new Driver());
        
        // Load gambar dari file yang diupload
        $image = $manager->read($file->getRealPath());
        
        // Encode ke WebP format dengan kualitas 85%
        $encoded = $image->toWebp(85);
        
        // Simpan ke storage
        Storage::disk('public')->put($path, (string) $encoded);
        
        return $path;
    }
}
