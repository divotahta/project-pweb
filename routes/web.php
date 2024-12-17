<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route publik
Route::get('/', function () {
    $products = \App\Models\Product::latest()->paginate(6);
    return view('welcome', compact('products'));
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/about', function () {return view('about');})->name('about');

// Route admin
Route::prefix('admin')->group(function () {
    // Login routes untuk admin
    Route::middleware('guest')->group(function () {
        // Halaman login admin
        Route::get('/', [AuthenticatedSessionController::class, 'create'])
            ->name('admin.login');

        // Proses login admin
        Route::post('/', [AuthenticatedSessionController::class, 'store']);

        // Redirect /admin/login ke 404
        Route::get('/login', function () {
            abort(404);
        });
    });

    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // CRUD Products
        Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');

        // Logout route
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        Route::get('/report', [ProductController::class, 'report'])
            ->name('admin.report');
    });
});

// Tidak perlu include auth.php jika hanya menggunakan login admin
// require __DIR__.'/auth.php';
