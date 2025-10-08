<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as InterventionImage; // Pastikan fasad Image yang benar di-import
use Symfony\Component\HttpFoundation\File\UploadedFile as FileUploadedFile;

class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
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

            // Data untuk Chart.js (ini sudah bagus)
            $chartData = Konten::selectRaw('DATE(tanggal) as tgl, COUNT(*) as total')
                ->groupBy('tgl')
                ->orderBy('tgl', 'asc')
                ->pluck('total', 'tgl');

            return view('page.konten.index', [
                'konten'      => $konten,
                'chartLabels' => $chartData->keys(),
                'chartData'   => $chartData->values(),
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading konten: ' . $e->getMessage());
            return view('error.index')->with('error', 'Terjadi kesalahan saat memuat konten.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul'   => 'required|string|max:255',
            'caption' => 'required|string',
            'tanggal' => 'required|date',
            // Aturan validasi gambar diubah menjadi array
            'gambar'  => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:1024',
                // Aturan kustom untuk validasi orientasi landscape
                function (string $attribute, FileUploadedFile $value, \Closure $fail) {
                    $imageSize = getimagesize($value->getRealPath());
                    $width = $imageSize[0];
                    $height = $imageSize[1];

                    if ($height >= $width) {
                        $fail('Gambar harus berorientasi landscape (lebar harus lebih besar dari tinggi).');
                    }
                },
            ],
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('konten', 'public');
            $validatedData['gambar'] = $path;
        }

        Konten::create($validatedData);

        return redirect()->route('konten.index')->with('success', 'Konten berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     * PENINGKATAN: Menggunakan Route Model Binding (Konten $konten)
     */
    public function update(Request $request, Konten $konten)
    {
        $validatedData = $request->validate([
            'judul'   => 'required|string|max:255',
            'caption' => 'required|string',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024', // Gambar tidak wajib diisi saat update
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada untuk menghemat ruang penyimpanan
            if ($konten->gambar && Storage::disk('public')->exists($konten->gambar)) {
                Storage::disk('public')->delete($konten->gambar);
            }

            // Simpan gambar baru dan perbarui path-nya
            $path = $request->file('gambar')->store('konten', 'public');
            $validatedData['gambar'] = $path;
        }

        $konten->update($validatedData);

        return redirect()->route('konten.index')->with('success', 'Konten berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * PENINGKATAN: Menggunakan Route Model Binding (Konten $konten)
     */
    public function destroy(Konten $konten)
    {
        try {
            // Hapus file gambar dari storage sebelum menghapus record dari DB
            if ($konten->gambar && Storage::disk('public')->exists($konten->gambar)) {
                Storage::disk('public')->delete($konten->gambar);
            }

            $konten->delete();

            // Mengembalikan respons JSON, cocok untuk request via Axios/AJAX
            return response()->json(['message' => 'Konten berhasil dihapus!']);
        } catch (\Exception $e) {
            Log::error('Error deleting konten: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus konten.'], 500);
        }
    }
}
