<?php

namespace App\Http\Controllers;

use App\Lib\StaffService;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class StaffController extends Controller
{
    protected StaffService $staffService;

    public function __construct()
    {
        $this->staffService = app('staffService');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = $this->staffService->getStaff();
        return view('admin.staff.index', [
            'staffMembers' => $staff
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->staffService->getStaffRoles();

        return view('admin.staff.create', [
            'staffRoles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fullName' => ['required', 'string'],
            'dateOfBirth' => ['required', 'date'],
            'phoneNumber' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'roleId' => ['required', 'integer']
        ]);

        $this->staffService->createStaff($data);

        return redirect()->route('admin.staff.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $staff = $this->staffService->getStaffById($id);
        $roles = $this->staffService->getStaffRoles();

        return view('admin.staff.edit', [
            'user' => $staff,
            'staffRoles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $req = $request->validate([
            'fullName' => ['required', 'string'],
            'dateOfBirth' => ['required', 'date'],
            'phoneNumber' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'role' => ['required', 'integer']
        ]);

        $this->staffService->editStaffDetails(
            $id,
            array_merge(
                $req,
                ['roleId' => $req['role']]
            )
        );

        return redirect()->route('admin.staff.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->staffService->deleteStaffMember($id);

        return redirect()->route("admin.staff.index");
    }
}
