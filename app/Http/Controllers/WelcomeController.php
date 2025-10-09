<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar konten terbaru.
     */
    public function index()
    {
        // Ambil 8 data konten terbaru dari database, diurutkan berdasarkan tanggal
        $kontenTerbaru = Konten::orderBy('tanggal', 'desc')->take(8)->get();

        // Kirim data tersebut ke view 'welcome'
        return view('welcome', [
            'konten' => $kontenTerbaru,
        ]);
    }
}
