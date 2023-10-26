<?php

namespace App\Lib;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    /**
     * @param int $handlerId staff member that recorded the transaction
     * @param array $items array<int, int>
     * @param string | null $notes
     * @return array [
     * id: int,
     * date: Carbon,
     * notes: string
     * ] | null
     */
    public function recordTransaction(
        int $handlerId,
        array $items,
        string|null $notes = null,
    ): array {
        if (count($items) === 0) {
            return null;
        }
        $dateHandled = Carbon::now();
        $transactionId = DB::table("transactions")->insertGetId([
            "handler_id" => $handlerId,
            "notes" => $notes,
            "date" => $dateHandled,
        ]);
        $productPrices = DB::table("products")
            ->select(["id", "price"])
            ->whereIn("id", array_keys($items))
            ->get()
            ->mapWithKeys(
                fn($val, $_key) => [
                    $val->id => $val->price,
                ],
            );
        DB::table("transaction_details")->insert(
            collect($items)
                ->map(
                    fn($val, $key) => [
                        "transaction_id" => $transactionId,
                        "product_id" => $key,
                        "quantity" => $val,
                        "price_per_unit" => $productPrices->get($key),
                    ],
                )
                ->values()
                ->toArray(),
        );
        return DB::table("transactions")
            ->select(["id", "date", "notes"])
            ->where("id", "=", $transactionId)
            ->get()
            ->map(
                fn($val, $key) => [
                    "id" => $val->id,
                    "date" => Carbon::parse($val->date),
                    "notes" => $val->notes,
                ],
            )
            ->first();
    }

    /**
     * @return array [
     * id: int,
     * handlerId: int,
     * date: Carbon,
     * notes: string,
     * totalSale: float,
     * items: [
     * productId: int,
     * productName: string,
     * quantity: int,
     * pricePerUnit: float,
     * unitTotal: float
     * ][]
     * ]
     */
    public function getTransactions(): array
    {
        $transactionKeys = collect(["handlerId", "date", "notes", "totalSale"]);
        $transactionDetailsKeys = collect([
            "productId",
            "productName",
            "quantity",
            "pricePerUnit",
            "unitTotal",
        ]);
        return DB::table("transactions")
            ->select([
                "transactions.id AS transactionId",
                "transactions.handler_id AS handlerId",
                "transactions.notes AS notes",
                "transactions.date AS date",
                DB::raw(
                    "SUM(transaction_details.quantity * transaction_details.price_per_unit) OVER (PARTITION BY transactions.id) AS totalSale",
                ),
                DB::raw(
                    "(transaction_details.quantity * transaction_details.price_per_unit) AS unitTotal",
                ),
                "transaction_details.product_id AS productId",
                "transaction_details.quantity AS quantity",
                "transaction_details.price_per_unit AS pricePerUnit",
                "products.name AS productName",
            ])
            ->join(
                "transaction_details",
                "transactions.id",
                "=",
                "transaction_details.transaction_id",
            )
            ->join("products", "transaction_details.product_id", "=", "products.id")
            ->get()
            ->map(fn($val, $_key) => collect(get_object_vars($val)))
            ->groupBy("transactionId")
            ->map(
                fn(Collection $rowsOfTransaction, int $key) => array_merge(
                    $rowsOfTransaction
                        ->first()
                        ->filter(fn($_v, $key) => $transactionKeys->contains($key))
                        ->toArray(),
                    [
                        "id" => $key,
                        "date" => Carbon::parse($rowsOfTransaction->first()->get("date")),
                    ],
                    [
                        "items" => $rowsOfTransaction
                            ->map(
                                fn(Collection $row) => $row->filter(
                                    fn($_v, $key) => $transactionDetailsKeys->contains($key),
                                ),
                            )
                            ->toArray(),
                    ],
                ),
            )
            ->values()
            ->toArray();
    }
}
