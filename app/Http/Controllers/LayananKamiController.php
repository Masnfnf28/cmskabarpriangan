<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayananKamiController extends Controller
{
    /**
     * Menampilkan halaman layanan kami.
     */
    public function index()
    {
        return view('layanan-kami');
    }
}
