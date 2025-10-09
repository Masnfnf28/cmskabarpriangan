<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    /**
     * Menampilkan daftar konten.
     */
    public function index(Request $request)
    {
        $query = Konten::query()->latest();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $konten = $query->paginate(8)->withQueryString();

        return view('page.konten.index', compact('konten'));
    }

    /**
     * Menyimpan konten baru.
     */
    public function store(Request $request)
    {
        // Validasi dasar yang disederhanakan
        $validatedData = $request->validate([
            'judul'   => 'required|string|max:255',
            'caption' => 'nullable|string',
            'tanggal' => 'required|date',
            'gambar'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maks 2MB
        ]);

        try {
            // 1. Simpan gambar
            $path = $request->file('gambar')->store('konten', 'public');
            
            // 2. Siapkan data untuk disimpan ke database
            $dataToCreate = $validatedData;
            $dataToCreate['gambar'] = $path;

            // 3. Simpan data ke database
            Konten::create($dataToCreate);

            // 4. Kembali dengan pesan sukses
            return redirect()->route('konten.index')->with('success', 'Konten baru berhasil ditambahkan!');

        } catch (\Exception $e) {
            // Jika terjadi error, catat di log dan kembali dengan pesan error
            Log::error('GAGAL MENYIMPAN KONTEN: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan internal saat menyimpan. Silakan periksa log.')->withInput();
        }
    }

    /**
     * Memperbarui konten.
     */
    public function update(Request $request, Konten $konten)
    {
        $validatedData = $request->validate([
            'judul'   => 'required|string|max:255',
            'caption' => 'nullable|string',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar tidak wajib saat update
        ]);
        
        try {
            $dataToUpdate = $request->except('gambar');

            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($konten->gambar && Storage::disk('public')->exists($konten->gambar)) {
                    Storage::disk('public')->delete($konten->gambar);
                }
                // Simpan gambar baru
                $path = $request->file('gambar')->store('konten', 'public');
                $dataToUpdate['gambar'] = $path;
            }

            $konten->update($dataToUpdate);

            return redirect()->route('konten.index')->with('success', 'Konten berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('GAGAL MEMPERBARUI KONTEN: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan internal saat memperbarui. Silakan periksa log.')->withInput();
        }
    }

    /**
     * Menghapus konten.
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
            Log::error('GAGAL MENGHAPUS KONTEN: ' . $e->getMessage());
            return redirect()->route('konten.index')->with('error', 'Terjadi kesalahan saat menghapus konten.');
        }
    }
}

