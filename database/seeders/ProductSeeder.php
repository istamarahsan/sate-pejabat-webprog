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
                "name" => "Serigala Cipularang",
                "price" => 69421,
                "category" => "OTHER",
            ],
            [
                "name" => "Serigala Cipularang 2",
                "price" => 69422,
                "category" => "OTHER",
            ],
            [
                "name" => "Serigala Cipularang 3",
                "price" => 69423,
                "category" => "OTHER",
            ],
        ]);
    }
}
