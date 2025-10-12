<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Konten;
use Illuminate\Http\Request;

class KontenController extends Controller
{
    public function index()
    {
        $konten = Konten::orderBy('tanggal', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Konten',
            'data' => $konten
        ]);
    }
}
