<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
                ->paginate(6)
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
                'mimes:jpeg,png,jpg,gif',
                'max:2048', // Batas maksimal 2MB
                // Validasi kustom untuk mendukung ukuran Instagram, YouTube, dan Poster
                function (string $attribute, UploadedFile $value, \Closure $fail) {
                    $imageSize = getimagesize($value->getRealPath());
                    $width = $imageSize[0];
                    $height = $imageSize[1];

                    // Hitung rasio aspek
                    $ratio = $width / $height;

                    // Daftar rasio yang diizinkan dengan toleransi ±0.1
                    $allowedRatios = [
                        1.0,    // Instagram Square (1:1)
                        0.8,    // Instagram Portrait (4:5)
                        0.5625, // Instagram Story/Reels (9:16)
                        1.7778, // YouTube (16:9)
                        0.7071, // Poster Portrait (A4: 1:1.414 atau 5:7)
                    ];

                    $isValid = false;
                    foreach ($allowedRatios as $allowedRatio) {
                        if (abs($ratio - $allowedRatio) <= 0.1) {
                            $isValid = true;
                            break;
                        }
                    }

                    if (!$isValid) {
                        $fail('Gambar harus memiliki rasio aspek yang sesuai: Instagram (1:1, 4:5, 9:16), YouTube (16:9), atau Poster (portrait).');
                    }
                },
            ],
        ]);

        // Membersihkan input caption dari HTML berbahaya
        $validatedData['caption'] = clean($request->input('caption'));

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('konten', 'public');
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
                'mimes:jpeg,png,jpg,gif',
                'max:2048', // Batas maksimal 2MB
                function (string $attribute, UploadedFile $value, \Closure $fail) {
                    $imageSize = getimagesize($value->getRealPath());
                    $width = $imageSize[0];
                    $height = $imageSize[1];

                    // Hitung rasio aspek
                    $ratio = $width / $height;

                    // Daftar rasio yang diizinkan dengan toleransi ±0.1
                    $allowedRatios = [
                        1.0,    // Instagram Square (1:1)
                        0.8,    // Instagram Portrait (4:5)
                        0.5625, // Instagram Story/Reels (9:16)
                        1.7778, // YouTube (16:9)
                        0.7071, // Poster Portrait (A4: 1:1.414 atau 5:7)
                    ];

                    $isValid = false;
                    foreach ($allowedRatios as $allowedRatio) {
                        if (abs($ratio - $allowedRatio) <= 0.1) {
                            $isValid = true;
                            break;
                        }
                    }

                    if (!$isValid) {
                        $fail('Gambar harus memiliki rasio aspek yang sesuai: Instagram (1:1, 4:5, 9:16), YouTube (16:9), atau Poster (portrait).');
                    }
                },
            ],
        ]);

        $validatedData['caption'] = clean($request->input('caption'));

        if ($request->hasFile('gambar')) {
            if ($konten->gambar && Storage::disk('public')->exists($konten->gambar)) {
                Storage::disk('public')->delete($konten->gambar);
            }

            $path = $request->file('gambar')->store('konten', 'public');
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
}
