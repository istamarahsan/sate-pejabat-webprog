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
        /*
        $table->id();
            $table->string("name");
            $table->double("price");
            $table->enum("category", ["FOOD", "BEVERAGE", "SNACK", "OTHER"]);
        */
        DB::table("products")->insert([
            [
                "id" => 10,
                "name" => "Sate Sapi",
                "price" => 50,
                "category" => "FOOD",
            ],
            [
                "id" => 11,
                "name" => "Sate Kambing",
                "price" => 70,
                "category" => "FOOD",
            ],
            [
                "id" => 13,
                "name" => "Sate ayam",
                "price" => 40,
                "category" => "FOOD",
            ],
            [
                "id" => 14,
                "name" => "Limun asem",
                "price" => 10,
                "category" => "BEVERAGE",
            ],
            [
                "id" => 15,
                "name" => "Apple Tea",
                "price" => 10,
                "category" => "BEVERAGE",
            ],
            [
                "id" => 16,
                "name" => "Milshake green tea",
                "price" => 15,
                "category" => "BEVERAGE",
            ],
            [
                "id" => 17,
                "name" => "Ice cream",
                "price" => 15,
                "category" => "SNACK",
            ],
            [
                "id" => 18,
                "name" => "Ice Cendol",
                "price" => 20,
                "category" => "SNACK",
            ],
            [
                "id" => 19,
                "name" => "Sup durian",
                "price" => 20,
                "category" => "OTHER",
            ],
        ]);
    }
}
