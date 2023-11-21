<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table("staff")->insert([
            [
                'user_id' => 1100,
                'name' => 'Bambang',
                'phone_number' => '081234567',
                'date_of_birth' => '2000-05-01',
                'address' => 'Pekalongan',
                'role_id' => 1111,
            ],
            [
                'user_id' => 2200,
                'name' => 'Suti',
                'phone_number' => '081234567',
                'date_of_birth' => '1989-08-12',
                'address' => 'Gunung Jati',
                'role_id' => 2222,
            ],
            [
                'user_id' => 3300,
                'name' => 'Erika',
                'phone_number' => '081234567',
                'date_of_birth' => '1995-05-23',
                'address' => 'Alam Sunter',
                'role_id' => 3333,
            ],
            [
                'user_id' => 4400,
                'name' => 'Jason',
                'phone_number' => '081234567',
                'date_of_birth' => '2022-05-01',
                'address' => 'Adem Sutera',
                'role_id' => 4444,
            ],
        ]);
    }
}
