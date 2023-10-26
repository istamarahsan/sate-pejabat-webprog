<?php

namespace App\Http\Controllers;

use App\Lib\ProductService;
use App\Lib\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected ProductService $productService;
    protected TransactionService $transactionService;

    public function __construct()
    {
        $this->productService = app("productService");
        $this->transactionService = app("transactionService");
    }

    public function index(Request $request)
    {
        return $this->adminIndex($request);
    }

    public function adminIndex(Request $request)
    {
        $transactions = $this->transactionService->getTransactions();
        return view("admin.transactions", [
            "transactions" => $transactions,
        ]);
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
        $userId = auth()->user()->id;
        $quantities = collect($request->all())
            ->filter(fn($_val, $key) => strpos($key, "item-") === 0)
            ->mapWithKeys(fn($val, $key) => [explode("-", $key)[1] => $val])
            ->toArray();
        $result = $this->transactionService->recordTransaction($userId, $quantities);
        return redirect()->route("staff.createtransaction");
    }
}
