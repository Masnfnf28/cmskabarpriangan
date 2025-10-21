<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3" data-aos="fade-down">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight tracking-wide flex items-center gap-2">
                <span>📈</span> Dashboard Analitik Dinamis
            </h2>
            <div class="flex items-center gap-4 text-sm">
                <div class="text-right">
                    <p class="text-xs text-gray-500 dark:text-gray-400">📅 Hari & Tanggal</p>
                    <p class="font-semibold text-gray-800 dark:text-gray-100" id="currentDate">Loading...</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500 dark:text-gray-400">🕐 Waktu</p>
                    <p class="font-semibold text-gray-800 dark:text-gray-100 tabular-nums" id="currentTime">00:00:00</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 dark:bg-gray-900 min-h-screen transition-all duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- RINGKASAN STATISTIK --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div
                    class="bg-gradient-to-br from-blue-600 to-indigo-500 text-white p-6 rounded-2xl shadow-xl hover:scale-105 transform transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="100">
                    <p class="text-lg opacity-90 mb-1">Total Konten</p>
                    <h1 class="text-4xl font-bold">{{ $totalKonten }}</h1>
                </div>
                <div
                    class="bg-gradient-to-br from-emerald-500 to-green-400 text-white p-6 rounded-2xl shadow-xl hover:scale-105 transform transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="200">
                    <p class="text-lg opacity-90 mb-1">Tahun Aktif</p>
                    <h1 class="text-4xl font-bold">{{ now()->year }}</h1>
                </div>
                <div
                    class="bg-gradient-to-br from-fuchsia-500 to-pink-500 text-white p-6 rounded-2xl shadow-xl hover:scale-105 transform transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="300">
                    <p class="text-lg opacity-90 mb-1">Total Aktivitas Tahunan</p>
                    <h1 class="text-4xl font-bold">{{ collect($dataPerBulan)->sum() }}</h1>
                </div>
            </div>

            {{-- GRAFIK & LAPORAN BULANAN --}}
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl p-6 transition-all duration-300"
                data-aos="zoom-in" data-aos-delay="400">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                        🥧 Distribusi Konten per Bulan
                    </h3>
                </div>

                <div class="flex flex-col sm:flex-row gap-8 items-center">
                    {{-- Kolom untuk Grafik Donut --}}
                    <div class="relative w-full sm:w-2/3 h-[300px] sm:h-[400px]">
                        <canvas id="kontenChart"></canvas>
                        <div id="chartCenterLabel"
                            class="absolute inset-0 flex flex-col items-center justify-center text-center text-2xl font-semibold text-gray-700 dark:text-gray-200 pointer-events-none">
                        </div>
                    </div>

                    {{-- Kolom untuk Laporan Bulanan (PENGGANTI LEGENDA) --}}
                    <div class="w-full sm:w-1/3 space-y-3">
                        <h4 class="font-semibold text-gray-600 dark:text-gray-300 border-b dark:border-gray-600 pb-2">
                            Laporan Bulan {{ now()->year }}</h4>

                        @foreach ($bulanLabels as $index => $label)
                            <div class="flex justify-between items-center text-sm py-1">
                                <div class="flex items-center gap-3">
                                    <span class="w-3 h-3 rounded-full"
                                        style="background-color: {{ $colors[$index] }}"></span>
                                    <span class="text-gray-700 dark:text-gray-200">{{ $label }}</span>
                                </div>
                                <span class="font-bold text-gray-800 dark:text-gray-100">
                                    {{ $dataPerBulan[$index] }} <span
                                        class="font-normal text-xs text-gray-500">konten</span>
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- SCRIPT CHART.JS --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // FUNGSI TANGGAL DAN WAKTU REALTIME
                function updateDateTime() {
                    const now = new Date();
                    
                    // Array nama hari dan bulan dalam Bahasa Indonesia
                    const hariIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    const bulanIndo = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                       'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    
                    // Format tanggal: Hari, DD Bulan YYYY
                    const hari = hariIndo[now.getDay()];
                    const tanggal = now.getDate();
                    const bulan = bulanIndo[now.getMonth()];
                    const tahun = now.getFullYear();
                    const dateString = `${hari}, ${tanggal} ${bulan} ${tahun}`;
                    
                    // Format waktu: HH:MM:SS
                    const jam = String(now.getHours()).padStart(2, '0');
                    const menit = String(now.getMinutes()).padStart(2, '0');
                    const detik = String(now.getSeconds()).padStart(2, '0');
                    const timeString = `${jam}:${menit}:${detik}`;
                    
                    // Update elemen HTML
                    document.getElementById('currentDate').textContent = dateString;
                    document.getElementById('currentTime').textContent = timeString;
                }
                
                // Update pertama kali
                updateDateTime();
                
                // Update setiap detik
                setInterval(updateDateTime, 1000);

                const ctx = document.getElementById('kontenChart').getContext('2d');

                const bulanLabels = @json($bulanLabels);
                const dataKonten = @json($dataPerBulan);
                const colors = @json($colors);

                const kontenChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: bulanLabels,
                        datasets: [{
                            label: 'Jumlah Konten',
                            data: dataKonten,
                            backgroundColor: colors,
                            borderWidth: 2,
                            borderColor: document.documentElement.classList.contains('dark') ?
                                '#1f2937' : '#fff',
                            hoverOffset: 18
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => `${ctx.label}: ${ctx.parsed} konten`
                                }
                            }
                        }
                    }
                });

                function updateCenterLabel() {
                    const total = dataKonten.reduce((a, b) => a + b, 0);
                    document.getElementById('chartCenterLabel').innerHTML = `
                    <span class="block text-sm opacity-70">Total Konten</span>
                    <span class="text-4xl font-bold">${total}</span>
                `;
                }

                updateCenterLabel();
            });
        </script>
    @endpush
</x-app-layout>
