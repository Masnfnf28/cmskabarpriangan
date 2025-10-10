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
        try {
            $query = Konten::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                        ->orWhere('caption', 'like', "%{$search}%");
                });
            }

            $konten = $query->orderBy('tanggal', 'desc')->paginate(6)->withQueryString();

            return view('page.konten.index', ['konten' => $konten]);
        } catch (\Exception $e) {
            Log::error('Error saat memuat konten: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat data.');
        }
    }

    /**
     * Menyimpan konten baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul'   => 'required|string|max:255',
            'caption' => 'required|string',
            'tanggal' => 'required|date',
            'gambar'  => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        // <-- PERUBAHAN KEAMANAN: Bersihkan input caption -->
        // Ini akan menghapus semua HTML berbahaya tapi membiarkan yang aman (seperti <a>, <strong>, dll.)
        $validatedData['caption'] = clean($request->input('caption'));

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('konten', 'public');
            $validatedData['gambar'] = $path;
        }

        Konten::create($validatedData);

        return redirect()->route('konten.index')->with('success', 'Konten berhasil ditambahkan.');
    }

    /**
     * Memperbarui konten.
     */
    public function update(Request $request, Konten $konten)
    {
        $validatedData = $request->validate([
            'judul'   => 'required|string|max:255',
            'caption' => 'required|string',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        // <-- PERUBAHAN KEAMANAN: Bersihkan input caption -->
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
     * Menghapus konten.
     */
    public function destroy(Konten $konten)
    {
        // <-- PERBAIKAN: Mengisi method destroy yang kosong -->
        try {
            // Hapus file gambar dari storage sebelum menghapus record dari DB
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
