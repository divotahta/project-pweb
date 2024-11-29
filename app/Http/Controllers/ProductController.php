<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Halaman index (untuk publik)
    public function index(Request $request)
    {
        $query = Product::query();

        // Pencarian berdasarkan nama produk atau deskripsi
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan kondisi
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // Pengurutan
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(9);

        return view('products.index', compact('products'));
    }

    // Method untuk admin (perlu login)
    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'condition' => 'required',
            'whatsapp' => 'required|regex:/^[0-9]{9,15}$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Format nomor WhatsApp
        $validated['whatsapp'] = '62' . ltrim($validated['whatsapp'], '0');

        Product::create($validated);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'condition' => 'required',
            'whatsapp' => 'required|regex:/^[0-9]{9,15}$/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Upload gambar baru
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Format nomor WhatsApp
        $validated['whatsapp'] = '62' . ltrim($validated['whatsapp'], '0');

        $product->update($validated);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Produk berhasil dihapus!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
