<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(RootAdminSeeder::class);
        $this->call(DebugSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(StaffRoleSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(TransactionDetailsSeeder::class);
    }
}
