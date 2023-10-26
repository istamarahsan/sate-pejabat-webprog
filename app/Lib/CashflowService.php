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
    public function getCashflowSummary(CarbonPeriod | null $period = null): array
    {
        $queryPart1 = DB::table('transactions')
        ->selectRaw(
            '
            products.category AS category, 
            SUM(transaction_details.quantity) AS quantitySold, 
            SUM(transaction_details.quantity * transaction_details.price_per_unit) AS salesTotal
            '
        )
        ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->join('products', 'transaction_details.product_id', '=', 'products.id');

        if ($period != null) {
            $queryPart1 = $queryPart1->whereBetween(
                'transactions.date',
                [
                    $period->getStartDate()->toDateString(),
                    $period->getEndDate()->toDateString()
                ]
                );
        }

        return $queryPart1
            ->groupBy('products.category')
            ->get()
            ->map(fn ($e) => get_object_vars($e))
            ->map(fn ($e) => array_merge($e, [
                'category' => ProductCategory::parse($e['category'])
            ]))
            ->toArray();
    }
}
