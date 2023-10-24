<?php

namespace App\Http\Controllers;

use App\Lib\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct()
    {
        $this->productService = app('productService');
    }

    public function get(Request $request)
    {

        $products = $this->productService->getAllProducts();

        return view('admin/products', [
            'products' => $products,
        ]);
    }
}
