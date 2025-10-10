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
                'max:1024', // Batas maksimal 1MB (1024 KB)
                // Validasi kustom untuk memastikan gambar adalah landscape
                function (string $attribute, UploadedFile $value, \Closure $fail) {
                    $imageSize = getimagesize($value->getRealPath());
                    $width = $imageSize[0];
                    $height = $imageSize[1];

                    if ($height >= $width) {
                        $fail('Gambar harus berorientasi landscape (lebar harus lebih besar dari tinggi).');
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
                'max:1024', // Batas maksimal 1MB
                function (string $attribute, UploadedFile $value, \Closure $fail) {
                    $imageSize = getimagesize($value->getRealPath());
                    if ($imageSize && $imageSize[1] >= $imageSize[0]) {
                        $fail('Gambar harus berorientasi landscape.');
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
