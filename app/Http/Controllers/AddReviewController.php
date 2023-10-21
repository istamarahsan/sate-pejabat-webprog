<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Lib\ReviewService;
use Illuminate\Http\Request;

class AddReviewController extends Controller
{
    protected ReviewService $reviewService;

    public function __construct()
    {
        $this->reviewService = app("reviewService");
    }

    public function get(Request $request)
    {
        return view('add-review', [
            'branchId' => $request->route('branchId')
        ]);
    }
    public function post(Request $request)
    {
        $branchId = $request->route('branchId');
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

        $reviewId = $this->reviewService->createReview($branchId, $details);

        if ($reviewId == null) {
            return response('no', 500);
        }

        return '<span>Thank you for leaving a review, ' . $details['name'] . '.</span>';
    }
}
