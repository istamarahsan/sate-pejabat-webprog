<?php

namespace App\Http\Controllers;

use App\Lib\CashflowService;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class CashflowController extends Controller
{
    protected CashflowService $cashflowService;
    public function __construct()
    {
        $this->cashflowService = app('cashflowService');
    }
    public function get(Request $request)
    {
        $cashflowSummary = $this->cashflowService->getCashflowSummary(new CarbonPeriod('2023-01-01', '2023-12-01'));
        return dd($cashflowSummary);
    }
}
