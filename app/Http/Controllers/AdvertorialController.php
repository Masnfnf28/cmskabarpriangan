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
            
            // 3. Increment views counter saat postingan dikunjungi
            if ($featuredPost) {
                $featuredPost->increment('views');
            }
        }

        // 3. Ambil post lain dengan paginasi
        if ($featuredPost) {
            // Jika ada featured post, ambil post lain kecuali featured
            $otherPosts = Konten::where('id', '!=', $featuredPost->id)
                ->orderBy('tanggal', 'desc')
                ->paginate(3);
        } else {
            // Jika tidak ada featured post (halaman pertama), tampilkan semua post
            $otherPosts = Konten::orderBy('tanggal', 'desc')
                ->paginate(3);
        }

        return view('advertorial', [
            'featuredPost' => $featuredPost,
            'otherPosts' => $otherPosts
        ]);
    }
}
