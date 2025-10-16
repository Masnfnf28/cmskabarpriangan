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
        // Ambil 8 data konten terbaru dari database, diurutkan berdasarkan tanggal dan id
        $kontenTerbaru = Konten::orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // Ambil 6 konten trending berdasarkan jumlah views terbanyak
        $kontenTrending = Konten::orderBy('views', 'desc')->take(5)->get();

        // Kirim data tersebut ke view 'welcome'
        return view('welcome', [
            'konten' => $kontenTerbaru,
            'trending' => $kontenTrending,
        ]);
    }
}
