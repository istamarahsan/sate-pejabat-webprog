<?php

namespace App\Http\Controllers;

use App\Lib\Branch\BranchService;
use App\Lib\Staff\StaffService;
use Illuminate\Http\Request;

class ManageStaffController extends Controller {
    protected StaffService $staffService;
    protected BranchService $branchService;

    public function __construct() {
        $this->staffService = app('staffService');
        $this->branchService = app('branchService');
        $this->middleware('auth');
    }

    public function get(Request $request) {
        $branchId = $request->route('branchId');
        $branch = $this->branchService->getBranch($branchId);
        if ($branch == null) {
            return response('Not Found', 404);
        }

        $staff = $this->staffService->getStaffFromBranch($branchId);
        return view('admin.manage-staff', [
            'branchId' => $branchId,
            'staffMembers' => $staff
        ]);
    }

    public function delete(Request $request) {
        $branchId = $request->route('branchId');
        $staffUserId = $request->route('staffId');

        $this->staffService->deleteStaffMember($staffUserId);

        return redirect('admin/' . $branchId);
    }
}