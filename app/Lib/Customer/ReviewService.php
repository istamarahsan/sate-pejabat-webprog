<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReviewService {

    /**
     * @return array [
     * id: int,
     * date: string,
     * name: string,
     * taste: int,
     * atmosphere: int,
     * cleanliness:int,
     * service: int,
     * price: int,
     * comments: string,
     * goals: string
     * ][]
     */
    public function getReviews(): array {
        $dbResult = DB::table('reviews')
            ->selectRaw('id, date, reviewer_name AS name, score_taste AS taste, score_atmosphere AS atmosphere, score_cleanliness AS cleanliness, score_service AS service, score_price AS price, reviewer_comments AS comments, reviewer_goals AS goals')
            ->get()
            ->toArray();

        return array_map(function ($e): array {
            return get_object_vars($e);
        }, $dbResult);
    }

    /**
     * @param $details array [
     * name: string,
     * taste: int,
     * atmosphere: int,
     * cleanliness:int,
     * service: int,
     * price: int,
     * comments: string,
     * goals: string
     * ]
     */
    public function createReview($details): int | null {
        [
            $name, 
            $taste, 
            $atmosphere, 
            $cleanliness, 
            $service,
            $price,
            $comments,
            $goals
        ] = $details;

        if (
            $this->array_any(function($e) {
                return $e < 1 || $e > 3;
            }, [$taste, $atmosphere, $cleanliness, $service, $price])
        ) {
            return null;
        }

        $now = Carbon::now();

        return DB::table('reviews')
            ->insertGetId([
                'date' => $now,
                'reviewer_name' => $name,
                'score_taste' => $taste,
                'score_atmosphere' => $atmosphere,
                'score_cleanliness' => $cleanliness,
                'score_service' => $service,
                'score_price' => $price,
                'reviewer_comments' => $comments,
                'reviewer_goals' => $goals
            ]);
    }

    private function array_any(callable $fn, array $array) {
        foreach ($array as $value) {
            if($fn($value)) {
                return true;
            }
        }
        return false;
    }
}