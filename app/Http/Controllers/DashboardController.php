<?php

namespace App\Http\Controllers;
use App\Models\Konten;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
         // Total semua konten
        $totalKonten = Konten::count();

        // Hitung jumlah konten per bulan (tahun berjalan)
        $kontenPerBulan = Konten::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal', Carbon::now()->year)
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan')
            ->toArray();

        // Label bulan (untuk grafik)
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        // Data konten (agar urut dari Jan–Des)
        $dataKonten = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataKonten[] = $kontenPerBulan[$i] ?? 0;
        }

        // Kirim data ke view
        return view('page.dashboard', compact('totalKonten', 'bulanLabels', 'dataKonten'));
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
