<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RootAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('users')->where('user_type', 'admin')->count() == 0) {
            DB::table('users')->insert([
                'id' => 1,
                'password' => Hash::make('admin'),
                'user_type' => 'admin',
            ]);
        }
    }
}
