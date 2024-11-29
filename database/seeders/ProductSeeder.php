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
            [
                'name' => 'iPhone 13 Pro Max 256GB',
                'description' => 'iPhone 13 Pro Max kondisi 98%, fullset, garansi iBox',
                'price' => 15500000,
                'condition' => 'Bekas - Seperti Baru',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456790'
            ],
            [
                'name' => 'Samsung Galaxy Z Fold 3',
                'description' => 'Samsung Z Fold 3 kondisi 95%, garansi SEIN',
                'price' => 12500000,
                'condition' => 'Bekas - Seperti Baru',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456791'
            ],
            [
                'name' => 'iPhone 12 128GB',
                'description' => 'iPhone 12 kondisi mulus, fullset, garansi personal',
                'price' => 7500000,
                'condition' => 'Bekas - Mulus',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456792'
            ],
            [
                'name' => 'Xiaomi Mi 11',
                'description' => 'Xiaomi Mi 11 kondisi 90%, fullset, garansi TAM',
                'price' => 4500000,
                'condition' => 'Bekas - Mulus',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456793'
            ],
            [
                'name' => 'OPPO Find X3 Pro',
                'description' => 'OPPO Find X3 Pro kondisi 95%, fullset, garansi resmi',
                'price' => 6800000,
                'condition' => 'Bekas - Seperti Baru',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456794'
            ],
            [
                'name' => 'Vivo X60 Pro',
                'description' => 'Vivo X60 Pro kondisi 92%, fullset, garansi resmi',
                'price' => 5200000,
                'condition' => 'Bekas - Mulus',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456795'
            ],
            [
                'name' => 'iPhone XR 128GB',
                'description' => 'iPhone XR kondisi 88%, fullset, no minus',
                'price' => 4200000,
                'condition' => 'Bekas - Mulus',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456796'
            ],
            [
                'name' => 'Samsung Galaxy Note 20 Ultra',
                'description' => 'Note 20 Ultra kondisi 94%, fullset, garansi SEIN',
                'price' => 8500000,
                'condition' => 'Bekas - Seperti Baru',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456797'
            ],
            [
                'name' => 'OnePlus 9 Pro',
                'description' => 'OnePlus 9 Pro kondisi 96%, fullset, garansi resmi',
                'price' => 7200000,
                'condition' => 'Bekas - Seperti Baru',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456798'
            ],
            [
                'name' => 'iPhone SE 2020',
                'description' => 'iPhone SE 2020 kondisi 89%, fullset, baterai 87%',
                'price' => 3500000,
                'condition' => 'Bekas - Mulus',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456799'
            ],
            [
                'name' => 'Poco F3',
                'description' => 'Poco F3 kondisi 93%, fullset, garansi resmi',
                'price' => 3200000,
                'condition' => 'Bekas - Mulus',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456800'
            ],
            [
                'name' => 'Realme GT',
                'description' => 'Realme GT kondisi 91%, fullset, garansi resmi',
                'price' => 4100000,
                'condition' => 'Bekas - Mulus',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456801'
            ],
            [
                'name' => 'iPhone 12 Mini',
                'description' => 'iPhone 12 Mini kondisi 97%, fullset, garansi iBox',
                'price' => 6300000,
                'condition' => 'Bekas - Seperti Baru',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456802'
            ],
            [
                'name' => 'Samsung Galaxy A52',
                'description' => 'Samsung A52 kondisi 90%, fullset, garansi SEIN',
                'price' => 2800000,
                'condition' => 'Bekas - Mulus',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456803'
            ],
            [
                'name' => 'Google Pixel 6',
                'description' => 'Pixel 6 kondisi 95%, fullset, inter',
                'price' => 7800000,
                'condition' => 'Bekas - Seperti Baru',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456804'
            ],
            [
                'name' => 'Huawei P40 Pro',
                'description' => 'Huawei P40 Pro kondisi 92%, fullset',
                'price' => 5900000,
                'condition' => 'Bekas - Mulus',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456805'
            ],
            [
                'name' => 'iPhone 13 128GB',
                'description' => 'iPhone 13 kondisi 98%, fullset, garansi resmi',
                'price' => 11500000,
                'condition' => 'Bekas - Seperti Baru',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456806'
            ],
            [
                'name' => 'Samsung Galaxy S22 Ultra',
                'description' => 'S22 Ultra kondisi 96%, fullset, garansi SEIN',
                'price' => 13500000,
                'condition' => 'Bekas - Seperti Baru',
                'image' => 'products/default.jpg',
                'whatsapp' => '628123456807'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
