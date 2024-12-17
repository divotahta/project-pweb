<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Daftar Produk</h2>
                        <div class="flex gap-4">
                        <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                            Tambah Produk
                        </a>
                        <a href="{{ route('admin.report') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            Laporan
                            </a>
                        </div>
                    </div>

                    <!-- Search Form -->
                    <div class="mb-6">
                        <form id="searchForm" class="flex gap-4">
                            <div class="flex-1">
                                <input type="text" 
                                       name="search" 
                                       id="searchInput"
                                       value="{{ request('search') }}"
                                       placeholder="Cari produk..." 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div class="w-48">
                                <select name="condition" 
                                        id="conditionSelect"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Kondisi</option>
                                    <option value="Bekas - Seperti Baru" {{ request('condition') == 'Bekas - Seperti Baru' ? 'selected' : '' }}>
                                        Bekas - Seperti Baru
                                    </option>
                                    <option value="Bekas - Mulus" {{ request('condition') == 'Bekas - Mulus' ? 'selected' : '' }}>
                                        Bekas - Mulus
                                    </option>
                                </select>
                            </div>

                            <div class="w-48">
                                <select name="category" 
                                        id="categorySelect"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- Results Info -->
                    @if(request('search') || request('condition'))
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

                    <!-- Products Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Gambar
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Harga
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kondisi
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kategori
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($products as $product)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img src="{{ Storage::url($product->image) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="h-16 w-16 object-cover rounded">
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->condition }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->category ? $product->category->name : 'Tanpa Kategori' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.products.edit', $product) }}" 
                                               class="text-blue-600 hover:text-blue-900 mr-3">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Tidak ada produk yang ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $products->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ajax -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const conditionSelect = document.getElementById('conditionSelect');
        const categorySelect = document.getElementById('categorySelect');
        let typingTimer;

        function performSearch() {
            const searchValue = searchInput.value;
            const conditionValue = conditionSelect.value;
            const categoryValue = categorySelect.value;
            const url = new URL(window.location.href);
            
            if (searchValue) {
                url.searchParams.set('search', searchValue);
            } else {
                url.searchParams.delete('search');
            }
            
            if (conditionValue) {
                url.searchParams.set('condition', conditionValue);
            } else {
                url.searchParams.delete('condition');
            }

            if (categoryValue) {
                url.searchParams.set('category', categoryValue);
            } else {
                url.searchParams.delete('category');
            }

            window.location.href = url.toString();
        }

        // waktu pencarian
        searchInput.addEventListener('input', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(performSearch, 500);
        });

        // pencarian langsung saat kondisi berubah
        conditionSelect.addEventListener('change', performSearch);
        categorySelect.addEventListener('change', performSearch);
    </script>
</x-app-layout>

