<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'condition' => 'required|string',
            'whatsapp' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024'
        ], [
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 1MB'
        ]);

        try {
            $data = $request->all();
            
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/products'), $filename);
                $data['image'] = 'products/' . $filename;
            } else {
                $data['image'] = 'products/default.jpg';
            }

            Product::create($data);

            return redirect()->route('admin.dashboard')
                           ->with('success', 'Produk berhasil ditambahkan');
                           
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'condition' => 'required|string',
            'whatsapp' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024'
        ], [
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 1MB'
        ]);

        try {
            $data = $request->all();
            
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($product->image && $product->image != 'products/default.jpg') {
                    if (file_exists(public_path('storage/' . $product->image))) {
                        unlink(public_path('storage/' . $product->image));
                    }
                }
                
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/products'), $filename);
                $data['image'] = 'products/' . $filename;
            }

            $product->update($data);

            return redirect()->route('admin.dashboard')
                           ->with('success', 'Produk berhasil diperbarui');
                           
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(Product $product)
    {
        try {
            if ($product->image && $product->image != 'products/default.jpg') {
                if (file_exists(public_path('storage/' . $product->image))) {
                    unlink(public_path('storage/' . $product->image));
                }
            }
            
            $product->delete();
            
            return redirect()->route('admin.dashboard')
                           ->with('success', 'Produk berhasil dihapus');
                           
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function report()
    {
        $kondisiHP = Product::select('condition', DB::raw('count(*) as total'))
                        ->groupBy('condition')
                        ->get();

        return view('admin.report', compact('kondisiHP'));
    }
}
