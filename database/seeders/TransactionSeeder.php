<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tambahkan contoh data transaksi
        Transaction::create([
            'user_id' => 1,
            'product_id' => 1,
            'price' => 50,
            'quantity' => 2,
            'admin_fee' => 5,
            'tax' => 5,
            'total' => 120,
        ]);

        Transaction::create([
            'user_id' => 2,
            'product_id' => 2,
            'price' => 75,
            'quantity' => 1,
            'admin_fee' => 7.5,
            'tax' => 7.5,
            'total' => 90,
        ]);

        // Tambahkan lebih banyak data transaksi sesuai kebutuhan
    }
}
