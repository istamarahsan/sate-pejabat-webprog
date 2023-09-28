<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Lib\Customer\ReviewService;
use Illuminate\Http\Request;

class AddReviewController extends Controller {
    protected ReviewService $reviewService;

    public function get(Request $request) {
        //   
    }
    public function post(Request $request) {
        $details = $request->validate([
            'name' => ['string', 'required'],
            'taste' => ['int', 'required'],
            'atmosphere' => ['int', 'required'],
            'cleanliness' => ['int', 'required'],
            'service' => ['int', 'required'],
            'price' => ['int', 'required'],
            'comments' => ['string', 'required'],
            'goals' => ['string', 'required']
        ]);

        $reviewId = $this->reviewService->createReview($details);

        if ($reviewId == null) {
            return response('no', 500);
        }

        return response('ok', 200);
    }
}