<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $query = Product::with('category');

        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        if (request('condition')) {
            $query->where('condition', request('condition'));
        }

        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        $products = $query->latest()->paginate(10);

        return view('admin.dashboard', compact('products', 'categories'));
    }
} 