<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('branches')->count() == 0) {
            DB::table('branches')->insert([
                'id' => 1,
                'name' => 'Null Branch'
            ]);
        }

        if (DB::table('staff_roles')->count() == 0) {
            DB::table('staff_roles')->insert([
                'id' => 1,
                'name' => 'Null Role'
            ]);
        }
    }
}
