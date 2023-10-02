<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Lib\Customer\ReviewService;
use Illuminate\Http\Request;

class ReviewsController extends Controller {
    protected ReviewService $reviewService;

    public function __construct() {
        $this->reviewService = app('reviewService');
        $this->middleware('auth');
    }

    public function get(Request $request) {
        $reviews = $this->reviewService->getReviews();
        return view('admin.view-reviews', [
            'reviews' => $reviews,
        ]);
    }
}