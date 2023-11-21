<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('staff_roles')->insert([
            [
                'id' => 1111,
                'name' => 'Common staff',
            ],
            [
                'id' => 2222,
                'name' => 'Cashier',
            ],
            [
                'id' => 3333,
                'name' => 'Common staff',
            ],
            [
                'id' => 4444,
                'name' => 'Kitchen staff',
            ],
        ]);
    }
}
