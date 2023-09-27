<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Lib\Branch\BranchService;
use App\Lib\Staff\StaffService;
use Illuminate\Http\Request;

class AddStaffController extends Controller
{
    protected StaffService $staffService;
    protected BranchService $branchService;

    public function __construct() {
        $this->staffService = app('staffService');
        $this->branchService = app('branchService');
    }

    public function get(Request $request) {
        $branchId = $request->route('branchId');
        
        $branch = $this->branchService->getBranch($branchId);
        if ($branch == null) {
            return response('Not Found', 404);
        }

        $roles = $this->staffService->getStaffRoles();

        return view('admin.add-staff', [
            'branch' => $branch,
            'staffRoles' => $roles
        ]);
    }
    public function post(Request $request) {
        $branchId = $request->route('branchId');

        $req = $request->validate([
            'fullName' => ['required', 'string'],
            'dateOfBirth' => ['required', 'date'],
            'phoneNumber' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'roleId' => ['required', 'integer']
        ]);

        $this->staffService->createStaffAtBranch($branchId, $req);

        return redirect('admin/' . (string)$branchId);
    }
}
