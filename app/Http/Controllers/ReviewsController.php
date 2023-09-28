<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Lib\Customer\ReviewService;
use Illuminate\Http\Request;

class ReviewsController extends Controller {
    protected ReviewService $reviewService;

    public function get(Request $request) {
        //   
    }
}