<?php

namespace App\Http\Controllers\Staff;

use App\Lib\Staff\StaffService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManageStaffController {
    protected StaffService $staffService;

    public function __construct() {
        $this->staffService = app('staffService');
    }

    public function get(Request $request) {
        $branchId = $request->route('branchId');
        $staff = $this->staffService->getStaffFromBranch($branchId);
        return view('admin.manage-staff', [
            'branchId' => $branchId,
            'staffMembers' => $staff
        ]);
    }
}