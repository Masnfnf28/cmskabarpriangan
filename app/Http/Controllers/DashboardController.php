<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Menghitung total semua konten
        $totalKonten = Konten::count();

        // 2. Mengambil rekap jumlah konten per bulan untuk tahun ini
        $kontenPerBulan = Konten::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal', Carbon::now()->year)
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan');

        // 3. Definisikan palet warna untuk grafik dan laporan
        $colors = [
            '#2563EB', '#16A34A', '#F59E0B', '#EF4444', '#8B5CF6', '#0EA5E9',
            '#14B8A6', '#F43F5E', '#A855F7', '#FB923C', '#10B981', '#3B82F6'
        ];

        // 4. Definisikan label nama bulan dalam Bahasa Indonesia
        $bulanLabels = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        // 5. Siapkan data 12 bulan, isi dengan 0 jika tidak ada konten
        $dataPerBulan = collect(range(1, 12))->map(function ($bulan) use ($kontenPerBulan) {
            return $kontenPerBulan->get($bulan, 0);
        })->values()->all();

        // 6. Kirim semua data yang sudah siap ke view
        return view('page.dashboard.index', [
            'totalKonten'  => $totalKonten,
            'bulanLabels'  => $bulanLabels,
            'dataPerBulan' => $dataPerBulan,
            'colors'       => $colors,
        ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}