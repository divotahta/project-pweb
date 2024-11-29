<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-6">Daftar Produk</h2>

                    <!-- Search and Filter Form -->
                    <div class="mb-8">
                        <form action="{{ route('products.index') }}" method="GET" class="space-y-4 md:space-y-0 md:flex md:gap-4">
                            <div class="flex-1">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Cari produk..." 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div class="md:w-48">
                                <select name="condition" 
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Kondisi</option>
                                    {{-- <option value="Bekas" {{ request('condition') == 'Bekas' ? 'selected' : '' }}>Bekas</option> --}}
                                    <option value="Bekas - Seperti Baru" {{ request('condition') == 'Bekas - Seperti Baru' ? 'selected' : '' }}>Bekas - Seperti Baru</option>
                                    <option value="Bekas - Mulus" {{ request('condition') == 'Bekas - Mulus' ? 'selected' : '' }}>Bekas - Mulus</option>
                                </select>
                            </div>
                            
                            <div class="md:w-48">
                                <select name="sort" 
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Urutkan</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                </select>
                            </div>

                            <div class="flex gap-2">
                                <button type="submit" 
                                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                    <i class="fas fa-search mr-2"></i>Cari
                                </button>
                                
                                <a href="{{ route('products.index') }}" 
                                   class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">
                                    <i class="fas fa-redo mr-2"></i>Reset
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Results Info -->
                    @if(request('search') || request('condition') || request('sort'))
                        <div class="mb-4 text-gray-600">
                            Menampilkan hasil pencarian {{ $products->total() }} produk
                            @if(request('search'))
                                untuk "{{ request('search') }}"
                            @endif
                            @if(request('condition'))
                                dengan kondisi {{ request('condition') }}
                            @endif
                        </div>
                    @endif

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($products as $product)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <a href="{{ route('products.show', $product) }}">
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-48 object-cover hover:opacity-90 transition">
                                </a>
                                <div class="p-4">
                                    <a href="{{ route('products.show', $product) }}" 
                                       class="text-xl font-semibold text-gray-900 hover:text-blue-600 mb-2 block">
                                        {{ $product->name }}
                                    </a>
                                    <p class="text-gray-600 mb-2">{{ Str::limit($product->description, 100) }}</p>
                                    <p class="text-lg font-bold text-gray-900 mb-2">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    <div class="mb-4">
                                        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-600">
                                            {{ $product->condition }}
                                        </span>
                                    </div>
                                    <a href="https://wa.me/{{ $product->whatsapp }}?text=Halo, saya tertarik dengan {{ $product->name }}" 
                                       target="_blank" 
                                       class="inline-block w-full text-center bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                                        <i class="fab fa-whatsapp mr-2"></i>Hubungi via WhatsApp
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <p class="text-gray-500">Tidak ada produk yang ditemukan</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $products->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
