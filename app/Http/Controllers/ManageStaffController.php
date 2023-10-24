<?php

namespace App\Http\Controllers;

use App\Lib\BranchService;
use App\Lib\StaffService;
use Illuminate\Http\Request;

class ManageStaffController extends Controller
{
    protected StaffService $staffService;
    protected BranchService $branchService;

    public function __construct()
    {
        $this->staffService = app('staffService');
        $this->branchService = app('branchService');
    }

    public function get(Request $request)
    {
        $branchId = $request->route('branchId');
        $branch = $this->branchService->getBranch($branchId);
        if ($branch == null) {
            return response('Not Found', 404);
        }

        $staff = $this->staffService->getStaffFromBranch($branchId);
        $branches = $this->branchService->getAllBranches();

        return view('admin.manage-staff', [
            'branchId' => $branchId,
            'branches' => $branches,
            'staffMembers' => $staff
        ]);
    }

    public function delete(Request $request)
    {
        $branchId = $request->route('branchId');
        $staffUserId = $request->route('staffId');

        $this->staffService->deleteStaffMember($staffUserId);

        return redirect('/' . $branchId . '/admin');
    }
}
