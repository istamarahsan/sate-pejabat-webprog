<?php

namespace App\Http\Controllers;

use App\Lib\CashflowService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

enum CashflowReportType: string
{
    case Day = "day";
    case Category = "category";
}

class CashflowController extends Controller
{

    protected CashflowService $cashflowService;

    public function __construct()
    {
        $this->cashflowService = app('cashflowService');
    }

    public function index(Request $request)
    {
        return view('admin.cashflow');
    }

    public function get(Request $request)
    {
        $data = $request->validate([
            "from" => "date",
            "until" => "date",
            "type" => [new Enum(CashflowReportType::class)]
        ]);
        if (!array_key_exists("type", $data)) {
            $data["type"] = CashflowReportType::Category;
        }
        if (array_key_exists("from", $data) && array_key_exists("until", $data)) {
            $from = Carbon::parse($data["from"]);
            $until = Carbon::parse($data["until"]);

            if ($from->isBefore($until)) {
                $data["from"] = $from;
                $data["until"] = $until;
            } else {
                unset($data["from"]);
                unset($data["until"]);
            }
        }

        $periodOrNull = array_key_exists("from", $data) && array_key_exists("until", $data)
            ? new CarbonPeriod($data["from"], $data["until"])
            : null;

        $cashflowSummary = $data["type"] == CashflowReportType::Category
            ? $this->cashflowService->getCashflowSummaryByCategory($periodOrNull)
            : $this->cashflowService->getCashflowSummaryByDay($periodOrNull);
        return response()->json($cashflowSummary);
    }
}
