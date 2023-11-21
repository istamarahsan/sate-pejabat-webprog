<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       
        DB::table("transactions")->insert([
            [
                'id' => 1101,
                'handler_id' => 1100,
                'notes' => 'Finished',
                'date' => '2019-03-03',
                //Carbon::now()->addDay(1)->toISOString()
            ],
            [
                'id' => 1102,
                'handler_id' => 2200,
                'notes' => 'Finished',
                'date' => '2019-04-04',
            ],
            [
                'id' => 1103,
                'handler_id' => 2200,
                'notes' => 'Finished',
                'date' => '2019-07-08',
            ],
        ]);

    }
}
