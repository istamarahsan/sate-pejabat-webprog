<?php

namespace App\Http\Controllers;

use App\Lib\CashflowService;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

enum CashflowReportType: string {
    case Day = "day";
    case Product = "product";
}

class CashflowController extends Controller
{
    

    protected CashflowService $cashflowService;

    public function __construct()
    {
        $this->cashflowService = app('cashflowService');
    }

    public function get(Request $request)
    {
        $data = $request->validate([
            "from" => "date",
            "until" => "date",
            "type" => [new Enum(CashflowReportType::class)]
        ]);
        if (!array_key_exists("type", $data)) {
            $data["type"] = CashflowReportType::Product;
        }

        $cashflowSummary = array_key_exists("from", $data) && array_key_exists("to", $data)
            ? $this->cashflowService->getCashflowSummaryByCategory(new CarbonPeriod($data["from"], $data["until"]))
            : $this->cashflowService->getCashflowSummaryByDay();
        return response()->json($cashflowSummary);
    }
}
