<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;

class AdvertorialController extends Controller
{
    /**
     * Menampilkan halaman detail advertorial.
     */
    public function index(Request $request)
    {
        $featuredPost = null;
        $otherPosts = collect(); // Gunakan collection kosong sebagai default

        // 1. Ambil ID post dari parameter URL
        $postId = $request->query('post');

        if ($postId) {
            // 2. Ambil HANYA SATU post yang sesuai dari database
            $featuredPost = Konten::find($postId);
        }

        // Jika tidak ada parameter 'post' atau post tidak ditemukan, coba ambil post terbaru
        if (!$featuredPost) {
            $featuredPost = Konten::orderBy('tanggal', 'desc')->first();
        }

        // 3. Jika post utama ditemukan, ambil post lain dengan paginasi
        if ($featuredPost) {
            // PERBAIKAN: Gunakan paginate() untuk mendapatkan objek Paginator
            $otherPosts = Konten::where('id', '!=', $featuredPost->id) // Ambil yang ID-nya tidak sama
                ->orderBy('tanggal', 'desc')
                ->paginate(6); // Batasi 6 post per halaman
        } else {
            // Jika database benar-benar kosong
            $otherPosts = Konten::paginate(6);
        }

        return view('advertorial', [
            'featuredPost' => $featuredPost,
            'otherPosts' => $otherPosts
        ]);
    }
}
