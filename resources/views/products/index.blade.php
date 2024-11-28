<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Daftar Produk</h2>

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
                                <p class="text-gray-500">Belum ada produk yang ditambahkan</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
