<x-app-layout>
    <x-slot name="slot">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="space-y-8">
                <h1 class="text-3xl font-bold text-center text-gray-900">Laporan Kondisi HP</h1>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <!-- Grafik Pie untuk Kondisi HP -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-semibold">Distribusi Kondisi HP</h2>
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-900">
                                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                                </a>
                            </div>  
                            <canvas id="kondisiChart" class="w-full" style="max-height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const kondisiData = {
                labels: {!! json_encode($kondisiHP->pluck('condition')) !!},
                datasets: [{
                    data: {!! json_encode($kondisiHP->pluck('total')) !!},
                    backgroundColor: [
                        'rgb(34, 197, 94)', // hijau untuk Baru
                        'rgb(59, 130, 246)', // biru untuk Bekas
                        'rgb(239, 68, 68)' // merah untuk Rusak
                    ]
                }]
            };

            // Konfigurasi grafik Pie
            const kondisiChart = new Chart(
                document.getElementById('kondisiChart'), {
                    type: 'pie',
                    data: kondisiData,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            title: {
                                display: true,
                                text: 'Distribusi Kondisi HP'
                            }
                        }
                    }
                }
            );
        </script>
    @endpush
</x-app-layout>
