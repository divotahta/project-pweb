<x-app-layout>
    <!-- Hero Section yang Lebih Menarik -->
    <div class="relative bg-gray-900 h-[600px]">
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero-bg.jpg') }}" class="w-full h-full object-cover opacity-50">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="text-white">
                <h1 class="text-5xl font-bold mb-4">Secondpedia</h1>
                <p class="text-xl mb-8">Platform Jual Beli HP Bekas Terpercaya di Indonesia</p>
                <a href="#products" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                    Lihat Produk
                </a>
            </div>
        </div>
    </div>

    <!-- Keunggulan Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Mengapa Memilih Secondpedia?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Terjamin Kualitasnya</h3>
                    <p class="text-gray-600">Semua produk telah melalui proses pengecekan ketat</p>
                </div>
                <div class="text-center p-6">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Harga Bersaing</h3>
                    <p class="text-gray-600">Dapatkan HP berkualitas dengan harga terbaik</p>
                </div>
                <div class="text-center p-6">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Layanan 24/7</h3>
                    <p class="text-gray-600">Tim support kami siap membantu Anda</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div id="products" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Produk Terbaru</h2>
            
            <!-- Search & Filter -->
            <div class="mb-8">
                <form class="flex gap-4">
                    <input type="text" 
                           placeholder="Cari produk..." 
                           class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <select class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kondisi</option>
                        <option value="baru">Baru</option>
                        <option value="bekas">Bekas</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(isset($products) && $products->count() > 0)
                    @foreach($products as $product)
                        @if($product)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-xl">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-56 object-cover">
                                @else
                                    <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                                
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                                    <div class="flex justify-between items-center mb-4">
                                        <p class="text-xl font-bold text-blue-600">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </p>
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            {{ $product->condition }}
                                        </span>
                                    </div>
                                    <a href="https://wa.me/{{ $product->whatsapp }}?text=Halo, saya tertarik dengan {{ $product->name }}" 
                                       target="_blank" 
                                       class="block w-full text-center bg-green-500 text-white px-4 py-3 rounded-lg hover:bg-green-600 transition duration-300">
                                        <i class="fab fa-whatsapp mr-2"></i>Hubungi via WhatsApp
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Belum ada produk yang ditambahkan</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if(isset($products) && $products->count() > 0)
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Testimonial Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Apa Kata Mereka?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-yellow-400 mb-4">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <p class="text-gray-600 mb-4">"Pelayanan sangat memuaskan, produk sesuai deskripsi."</p>
                    <p class="font-semibold">- Ahmad Santoso</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-yellow-400 mb-4">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <p class="text-gray-600 mb-4">"Harga bersaing dan kualitas terjamin. Recommended!"</p>
                    <p class="font-semibold">- Budi Prakoso</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-yellow-400 mb-4">
                        ⭐⭐⭐⭐⭐
                    </div>
                    <p class="text-gray-600 mb-4">"Proses transaksi mudah dan aman. Terima kasih Secondpedia!"</p>
                    <p class="font-semibold">- Siti Aminah</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
