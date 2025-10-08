<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight tracking-wide flex items-center gap-2">
            <span>📈</span> Dashboard Analitik Dinamis
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 dark:bg-gray-900 min-h-screen transition-all duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- RINGKASAN STATISTIK --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-blue-600 to-indigo-500 text-white p-6 rounded-2xl shadow-xl hover:scale-105 transform transition-all duration-300">
                    <p class="text-lg opacity-90 mb-1">Total Konten</p>
                    <h1 class="text-4xl font-bold">{{ $totalKonten }}</h1>
                </div>
                <div class="bg-gradient-to-br from-emerald-500 to-green-400 text-white p-6 rounded-2xl shadow-xl hover:scale-105 transform transition-all duration-300">
                    <p class="text-lg opacity-90 mb-1">Tahun Aktif</p>
                    <h1 class="text-4xl font-bold">{{ now()->year }}</h1>
                </div>
                <div class="bg-gradient-to-br from-fuchsia-500 to-pink-500 text-white p-6 rounded-2xl shadow-xl hover:scale-105 transform transition-all duration-300">
                    <p class="text-lg opacity-90 mb-1">Total Aktivitas Bulanan</p>
                    <h1 class="text-4xl font-bold">{{ collect($dataPerBulan)->sum() }}</h1>
                </div>
            </div>

            {{-- GRAFIK DONUT DINAMIS --}}
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl p-6 transition-all duration-300">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                        🥧 Distribusi Konten per Bulan
                    </h3>
                    <span class="text-gray-500 dark:text-gray-400 text-sm">
                        Tahun {{ now()->year }}
                    </span>
                </div>

                <div class="relative w-full h-[300px] sm:h-[400px] flex justify-center items-center">
                    <canvas id="kontenChart"></canvas>
                    <div id="chartCenterLabel"
                         class="absolute text-center text-2xl font-semibold text-gray-700 dark:text-gray-200 pointer-events-none">
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- SCRIPT CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('kontenChart').getContext('2d');

        const bulanLabels = @json($bulanLabels);
        const dataKonten = @json($dataPerBulan);

        const colors = [
            '#2563EB', '#16A34A', '#F59E0B', '#EF4444', '#8B5CF6', '#0EA5E9',
            '#14B8A6', '#F43F5E', '#A855F7', '#FB923C', '#10B981', '#3B82F6'
        ];

        const kontenChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: bulanLabels,
                datasets: [{
                    label: 'Jumlah Konten',
                    data: dataKonten,
                    backgroundColor: colors,
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 18
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: window.innerWidth < 640 ? 'bottom' : 'right',
                        labels: {
                            color: '#374151',
                            font: { size: 13, family: 'Inter, sans-serif' },
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 15
                        }
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
                <span class="block text-sm opacity-70">Total</span>
                ${total}
            `;
        }

        updateCenterLabel();

        window.addEventListener('resize', () => {
            kontenChart.options.plugins.legend.position = window.innerWidth < 640 ? 'bottom' : 'right';
            kontenChart.update();
        });
    </script>
</x-app-layout>
