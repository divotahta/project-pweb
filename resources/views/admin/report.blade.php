<x-app-layout>
    <x-slot name="slot">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="space-y-8">
                <h1 class="text-3xl font-bold text-center text-gray-900">Laporan Jumlah HP</h1>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <!-- Grafik Bar untuk Kategori HP -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-semibold">Jumlah HP</h2>
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-900">
                                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                                </a>
                            </div>  
                            <canvas id="kategoriChart" class="w-full" style="max-height: 400px;"></canvas>
                            <p class="text-center font-bold text-gray-500 mt-4">Total Semua HP = {{ $kategoriHP->pluck('products_count')->sum() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const kategoriData = {
                labels: {!! json_encode($kategoriHP->pluck('name')) !!},
                datasets: [{
                    label: 'Jumlah HP',
                    data: {!! json_encode($kategoriHP->pluck('products_count')) !!},
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',   // Biru
                        'rgba(255, 99, 132, 0.8)',   // Merah
                        'rgba(75, 192, 192, 0.8)',   // Hijau
                        'rgba(255, 206, 86, 0.8)',   // Kuning
                        'rgba(153, 102, 255, 0.8)',  // Ungu
                        'rgba(255, 159, 64, 0.8)',   // Oranye
                        'rgba(199, 199, 199, 0.8)',  // Abu-abu
                        'rgba(83, 102, 255, 0.8)',   // Biru Tua
                        'rgba(255, 99, 71, 0.8)',    // Merah Muda
                        'rgba(60, 179, 113, 0.8)'    // Hijau Muda
                    ],
                    borderColor: 'rgba(200, 200, 200, 1)',
                    borderWidth: 1
                }]
            };

            // Konfigurasi grafik Bar
            const kategoriChart = new Chart(
                document.getElementById('kategoriChart'), {
                    type: 'bar',
                    data: kategoriData,
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: ''
                            }
                        }
                    }
                }
            );
        </script>
    @endpush
</x-app-layout>
