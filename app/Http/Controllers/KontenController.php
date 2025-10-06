<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $konten = Konten::paginate(6);
            return view('page.konten.index')->with([
                'konten' => $konten,
            ]);
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " .
                addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'caption' => 'required|string',
            'tanggal' => 'required|date',
            'url' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Cek apakah ada file gambar yang di-upload
        if ($request->hasFile('gambar')) {
            // 3. Simpan gambar ke storage/app/public/konten
            // dan simpan path-nya ke dalam variabel $path
            $path = $request->file('gambar')->store('konten', 'public');
            
            // 4. Masukkan path gambar ke dalam data yang akan disimpan
            $validated['gambar'] = $path;
        }

        // 5. Simpan semua data ke database
        Konten::create($validated);

        return redirect()->route('konten.index')->with('success', 'Konten berhasil ditambahkan!');
    
        // try {
        //     $data = [
        //         'judul' => $request->input('judul'),
        //         'caption' => $request->input('caption'),
        //         'tanggal' => $request->input('tanggal'),
        //         'gambar' => $request->input('gambar'),
        //         'url' => $request->input('url'),
        //     ];
        //     Konten::create($data);

        //     return redirect()
        //         ->route('konten.index')
        //         ->with('message_insert', 'Data konten Sudah ditambahkan');
        // } catch (\Exception $e) {
        //     echo "<script>console.error('PHP Error: " .
        //         addslashes($e->getMessage()) . "');</script>";
        //     return view('error.index');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // try {
        //     $data = [
        //         'judul' => $request->input('judul'),
        //         'caption' => $request->input('caption'),
        //         'tanggal' => $request->input('tanggal'),
        //         'gambar' => $request->input('gambar'),
        //         'url' => $request->input('url'),
        //     ];


        //     $datas = Konten::findOrFail($id);
        //     $datas->update($data);
        //     return redirect()
        //         ->route('konten.index')
        //         ->with('message_insert', 'Data Konten Sudah ditambahkan');
        // } catch (\Exception $e) {
        //     echo "<script>console.error('PHP Error: " .
        //         addslashes($e->getMessage()) . "');</script>";
        //     return view('error.index');
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Konten::findOrFail($id);
            $data->delete();
            return back()->with('message_delete', 'Data Konten Sudah dihapus');

            return redirect()
                ->route('Konten.index')
                ->with('message_insert', 'Data Konten Sudah ditambahkan');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " .
                addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }
}
