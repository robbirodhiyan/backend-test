<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tambahkan contoh data produk
        Product::create([
            'name' => 'Product A',
            'price' => 50,
            'quantity' => 100,
        ]);

        Product::create([
            'name' => 'Product B',
            'price' => 75,
            'quantity' => 80,
        ]);

        // Tambahkan lebih banyak data produk sesuai kebutuhan
    }
}
