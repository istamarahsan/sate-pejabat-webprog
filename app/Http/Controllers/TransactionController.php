<?php

namespace App\Http\Controllers;

use App\Lib\ProductService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected ProductService $productService;

    public function __construct()
    {
        $this->productService = app("productService");
    }

    public function staffCreate(Request $request)
    {
        $products = $this->productService->getAllProducts();
        return view("staff.add-transaction", [
            "products" => $products,
        ]);
    }
    public function staffStore(Request $request)
    {
        return dd($request->all());
    }
}
