<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'iPhone 11 64GB',
                'description' => 'iPhone 11 bekas kondisi 95% mulus, fullset dengan kelengkapan lengkap',
                'price' => 5500000,
                'condition' => 'Bekas - Seperti Baru',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456789'
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'description' => 'Samsung S21 bekas kondisi 90%, masih garansi resmi',
                'price' => 6500000,
                'condition' => 'Bekas - Mulus',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456789'
            ],
            // Tambahkan data dummy lainnya...
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
