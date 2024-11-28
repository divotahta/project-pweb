<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route publik
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Route admin
Route::prefix('admin')->group(function () {
    // Login route
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    // Route yang butuh autentikasi
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            $products = \App\Models\Product::latest()->get();
            return view('dashboard', compact('products'));
        })->name('admin.dashboard');

        // CRUD Products
        Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    });
});

require __DIR__.'/auth.php';
