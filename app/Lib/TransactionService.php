<?php

namespace App\Lib;

use Carbon\Carbon;
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
}
