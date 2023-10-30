<?php

namespace App\Lib;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReviewService
{
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
    public function getReviews(): array
    {
        return DB::table("reviews")
            ->selectRaw(
                "id, date, reviewer_name AS name, score_taste AS taste, score_atmosphere AS atmosphere, score_cleanliness AS cleanliness, score_service AS service, score_price AS price, reviewer_comments AS comments, reviewer_goals AS goals",
            )
            ->get()
            ->map(fn($e) => get_object_vars($e))
            ->toArray();
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
    public function createReview($details): int|null
    {
        if (
            $this->array_any(
                function ($e) {
                    return $e < 1 || $e > 6;
                },
                [
                    $details["taste"],
                    $details["atmosphere"],
                    $details["cleanliness"],
                    $details["service"],
                    $details["price"],
                ],
            )
        ) {
            return null;
        }

        $now = Carbon::now();

        return DB::table("reviews")->insertGetId([
            "date" => $now,
            "reviewer_name" => $details["name"],
            "score_taste" => $details["taste"],
            "score_atmosphere" => $details["atmosphere"],
            "score_cleanliness" => $details["cleanliness"],
            "score_service" => $details["service"],
            "score_price" => $details["price"],
            "reviewer_comments" => $details["comments"],
            "reviewer_goals" => $details["goals"],
        ]);
    }

    private function array_any(callable $fn, array $array)
    {
        foreach ($array as $value) {
            if ($fn($value)) {
                return true;
            }
        }
        return false;
    }
}
