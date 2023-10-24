<?php

namespace App\Http\Controllers;

use App\Lib\StaffService;
use Illuminate\Http\Request;

class ManageStaffController extends Controller
{
    protected StaffService $staffService;

    public function __construct()
    {
        $this->staffService = app('staffService');
    }

    public function get(Request $request)
    {

        $staff = $this->staffService->getStaff();

        return view('admin.manage-staff', [
            'staffMembers' => $staff
        ]);
    }

    public function delete(Request $request)
    {
        $staffUserId = $request->route('staffId');

        $this->staffService->deleteStaffMember($staffUserId);

        return redirect(route('admin'));
    }
}
