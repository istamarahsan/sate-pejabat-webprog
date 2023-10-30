<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Lib\ReviewService;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    protected ReviewService $reviewService;

    public function __construct()
    {
        $this->reviewService = app("reviewService");
    }

    public function index(Request $request)
    {
        $reviews = $this->reviewService->getReviews();
        return view("admin.reviews.index", [
            "reviews" => $reviews,
        ]);
    }

    public function create()
    {
        return view("add-review");
    }

    public function store(Request $request)
    {
        $details = $request->validate([
            "name" => ["string", "required"],
            "taste" => ["int", "required"],
            "atmosphere" => ["int", "required"],
            "cleanliness" => ["int", "required"],
            "service" => ["int", "required"],
            "price" => ["int", "required"],
            "comments" => ["string", "required"],
            "goals" => ["string", "required"],
        ]);

        $reviewId = $this->reviewService->createReview($details);

        if ($reviewId == null) {
            return response("no", 500);
        }

        return "<span>Thank you for leaving a review, " . $details["name"] . ".</span>";
    }
}
