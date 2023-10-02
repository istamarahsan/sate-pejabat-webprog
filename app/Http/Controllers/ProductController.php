<?php

namespace App\Http\Controllers;

use App\Lib\Branch\BranchService;
use Illuminate\Http\Request;

class ProductController extends Controller {
    protected BranchService $branchService;

    public function __construct() {
        $this->branchService = app('branchService');
        $this->middleware('auth');
    }

    public function get(Request $request) {
        $branchId = $request->route('branchId');
        $branch = $this->branchService->getBranch($branchId);
        if ($branch == null) {
            return response('Not Found', 404);
        }

        $branches = $this->branchService->getAllBranches();

        return view('admin/products', [
            'branchId' => $branchId,
            'branches' => $branches,
        ]);
    }
}