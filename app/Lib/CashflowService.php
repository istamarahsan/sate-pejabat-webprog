<?php

namespace App\Lib;

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class CashflowService
{
    /**
     * @return [
     * category: ProductCategory,
     * quantitySold: int,
     * salesTotal: float
     * ]
     */
    public function getCashflowSummary(CarbonPeriod $period): array
    {
        return DB::table('transactions')
            ->selectRaw(
                '
                products.category AS category, 
                SUM(transaction_details.quantity) AS quantitySold, 
                SUM(transaction_details.quantity * transaction_details.price_per_unit) AS salesTotal'
            )
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->whereBetween(
                'transactions.date',
                [
                    $period->getStartDate()->toDateString(),
                    $period->getEndDate()->toDateString()
                ]
            )
            ->groupBy('products.category')
            ->get()
            ->map(fn ($e) => get_object_vars($e))
            ->map(fn ($e) => array_merge($e, [
                'category' => $this->parseProductCategory($e['category'])
            ]))
            ->toArray();
    }

    private function parseProductCategory($in)
    {
        switch (strtolower($in)) {
            case 'food':
                return ProductCategory::Food;
            case 'beverage':
                return ProductCategory::Beverage;
            case 'snack':
                return ProductCategory::Snack;
            case 'other':
                return ProductCategory::Other;
            default:
                return null;
        }
    }
}
