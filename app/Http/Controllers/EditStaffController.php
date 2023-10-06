<?php

namespace App\Http\Controllers;

use App\Lib\StaffService;
use Illuminate\Http\Request;

class EditStaffController extends Controller {
    protected StaffService $staffService;

    public function __construct() {
        $this->staffService = app('staffService');
    }

    public function get(Request $request) {
        $branchId = $request->route('branchId');
        $staffUserId = $request->route('staffId');

        $staff = $this->staffService->getStaffById($staffUserId);
        $roles = $this->staffService->getStaffRoles();

        return view('admin.edit-staff', [
            'branchId' => $branchId,
            'user' => $staff,
            'staffRoles' => $roles
        ]);
    }

    public function post(Request $request) {
        $branchId = $request->route('branchId');
        $staffUserId = $request->route('staffId');

        $req = $request->validate([
            'fullName' => ['required', 'string'],
            'dateOfBirth' => ['required', 'date'],
            'phoneNumber' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'role' => ['required', 'integer']
        ]);

        $this->staffService->editStaffDetails(
            $staffUserId,
            array_merge(
                $req, 
                ['roleId' => $req['role']]
            )
        );

        return redirect('admin/' . $branchId);
    }
}