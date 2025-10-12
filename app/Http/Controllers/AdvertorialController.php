<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AdvertorialController extends Controller
{
    /**
     * Menampilkan halaman advertorial dengan data langsung dari database.
     */
    public function index(Request $request)
    {
        $featuredPost = null;
        // Ambil semua postingan, diurutkan dari yang terbaru
        $allPosts = Konten::orderBy('tanggal', 'desc')->get();

        // Cari post yang akan ditampilkan di bagian "featured" berdasarkan parameter URL
        $postId = $request->query('post');
        if ($postId) {
            // firstWhere akan mencari item pertama yang cocok
            $featuredPost = $allPosts->firstWhere('id', $postId);
        }

        // Jika tidak ada post yang dipilih (atau tidak ditemukan), tampilkan post pertama sebagai default
        if (!$featuredPost && !$allPosts->isEmpty()) {
            $featuredPost = $allPosts->first();
        }

        // Ambil semua post lain, kecuali yang sedang ditampilkan sebagai "featured"
        $postsForGrid = $allPosts->when($featuredPost, function ($collection) use ($featuredPost) {
            // PERBAIKAN: Menghapus kesalahan ketik 'kkena'
            return $collection->where('id', '!=', $featuredPost->id);
        });

        // Lakukan paginasi manual pada sisa post
        $perPage = 6;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $postsForGrid->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $otherPosts = new LengthAwarePaginator($currentPageItems, count($postsForGrid), $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('advertorial', [
            'featuredPost' => $featuredPost,
            'otherPosts' => $otherPosts
        ]);
    }
}
