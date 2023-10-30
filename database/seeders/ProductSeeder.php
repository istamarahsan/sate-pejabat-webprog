<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("products")->insert([
            [
                "name" => "Product 1",
                "price" => 69421,
                "category" => "FOOD",
            ],
            [
                "name" => "Product 2",
                "price" => 69422,
                "category" => "BEVERAGE",
            ],
            [
                "name" => "Product 3",
                "price" => 69423,
                "category" => "OTHER",
            ],
        ]);
    }
}
