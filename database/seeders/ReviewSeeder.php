<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        $table->id();
            $table->date("date");
            $table->string("reviewer_name");
            $table->integer("score_taste");
            $table->integer("score_atmosphere");
            $table->integer("score_cleanliness");
            $table->integer("score_service");
            $table->integer("score_price");
            $table->text("reviewer_comments");
            $table->text("reviewer_goals");
        */

        DB::table("reviews")->insert([
            [
                'date' => '04-04-2019',
                'reviewer_name' => 'MIta',
                'score_taste' => 80,
                'score_atmosphere' => 85,
                'score_cleanliness' => 78,
                'score_service' => 90,
                'score_price' => 80,
                'reviewer_comments' => 'Nice',
                'reviewer_goals' => 'want to try sate ayam again',
            ],
            [
                'date' => '04-04-2019',
                'reviewer_name' => 'Bony',
                'score_taste' => 90,
                'score_atmosphere' => 78,
                'score_cleanliness' => 83,
                'score_service' => 85,
                'score_price' => 82,
                'reviewer_comments' => 'Good',
                'reviewer_goals' => 'Try ice cream',
            ],
            [
                'date' => '05-04-2019',
                'reviewer_name' => 'Willy',
                'score_taste' => 87,
                'score_atmosphere' => 95,
                'score_cleanliness' => 90,
                'score_service' => 87,
                'score_price' => 88,
                'reviewer_comments' => 'Nice nice',
                'reviewer_goals' => 'Try sate ayam',
            ],
        ]);
    }
}
