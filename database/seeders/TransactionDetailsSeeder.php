<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        DB::table("transaction_details")->insert([
            [
                'transaction_id' => 1101,
                'product_id' => 10,
                'quantity' => 12,
                'price_per_unit' => 50,
            ],
            [
                'transaction_id' => 1102,
                'product_id' => 11,
                'quantity' => 8,
                'price_per_unit' => 70,
            ],
            [
                'transaction_id' => 1103,
                'product_id' => 15,
                'quantity' => 20,
                'price_per_unit' => 10,
            ],
        ]);

    }
}
