<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-gray-100 rounded-lg p-8 mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Secondpedia</h1>
                <p class="text-lg text-gray-600">Temukan HP bekas berkualitas dengan harga terjangkau</p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(isset($products) && $products->count() > 0)
                    @foreach($products as $product)
                        @if($product)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                                
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
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
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
