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
        $this->reviewService = app('reviewService');
    }

    public function get(Request $request)
    {
        $reviews = $this->reviewService->getReviews();
        return view('admin.view-reviews', [
            'reviews' => $reviews,
        ]);
    }
}
