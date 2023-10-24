<?php

namespace App\Http\Controllers;

use App\Lib\StaffService;
use Illuminate\Http\Request;

class AddStaffController extends Controller
{
    protected StaffService $staffService;

    public function __construct()
    {
        $this->staffService = app('staffService');
    }

    public function get(Request $request)
    {
        $roles = $this->staffService->getStaffRoles();

        return view('admin.add-staff', [
            'staffRoles' => $roles
        ]);
    }
    public function post(Request $request)
    {
        $data = $request->validate([
            'fullName' => ['required', 'string'],
            'dateOfBirth' => ['required', 'date'],
            'phoneNumber' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'roleId' => ['required', 'integer']
        ]);

        $this->staffService->createStaff($data);

        return redirect(route('admin'));
    }
}
