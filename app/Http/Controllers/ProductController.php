<?php

namespace App\Http\Controllers;

use App\Lib\BranchService;
use App\Lib\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller {
    protected ProductService $productService;
    protected BranchService $branchService;

    public function __construct() {
        $this->productService = app('productService');
        $this->branchService = app('branchService');
    }

    public function get(Request $request) {
        $branchId = $request->route('branchId');
        $branch = $this->branchService->getBranch($branchId);
        if ($branch == null) {
            return response('Not Found', 404);
        }

        $products = $this->productService->getAllProducts();
        $branches = $this->branchService->getAllBranches();

        return view('admin/products', [
            'branchId' => $branchId,
            'branches' => $branches,
            'products' => $products,
        ]);
    }
}