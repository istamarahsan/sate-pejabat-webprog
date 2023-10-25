<?php

namespace App\Http\Controllers;

use App\Lib\ProductCategory;
use App\Lib\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct()
    {
        $this->productService = app('productService');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create', [
            'categories' => collect(ProductCategory::values())->map(fn ($e) => $e->toString())->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'price' => 'numeric|required',
            'category' => 'string|required'
        ]);
        $data['category'] = ProductCategory::parse($data['category']);
        $this->productService->createProduct($data);
        return redirect()->route('admin.products.index');
    }

    public function edit(Request $request, string $id)
    {
        $product = $this->productService->getProduct(intval($id));
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => collect(ProductCategory::values())->map(fn ($e) => $e->toString())->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'price' => 'numeric|required',
            'category' => 'string|required'
        ]);
        $data['category'] = ProductCategory::parse($data['category']);
        $this->productService->updateProduct($id, $data);
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productService->deleteProduct($id);
        return redirect()->route('admin.products.index');
    }
}
