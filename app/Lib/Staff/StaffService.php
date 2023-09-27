<?php

namespace App\Lib\Staff;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffService {
    /**
     * @return array [
     * id: int, 
     * name: string
     * ][]
     */
    public function getStaffRoles(): array {
        return DB::table('staff_roles')
            ->select(['id', 'name'])
            ->get()
            ->toArray();
    }
    /**
     * @return array [
     * id: int, 
     * name: string, 
     * phoneNumber: string,
     * dateOfBirth: string,
     * address: string,
     * roleId: int,
     * roleName: string
     * ][]
     */
    public function getStaffFromBranch($branchId): array {
        $dbResult = DB::table('staff')
                ->selectRaw('staff.user_id AS id, staff.name, staff.phone_number, staff.date_of_birth, staff.address, staff_roles.id AS role_id, staff_roles.name AS role_name')
                ->where('branch_id', '=', $branchId)
                ->join('staff_roles', 'staff.role_id', '=', 'staff_roles.id')
                ->get()
                ->toArray();
        return array_map(function ($row) {
            return [
                'id' => $row->id,
                'name' => $row->name,
                'phoneNumber' => $row->phone_number,
                'dateOfBirth' => $row->date_of_birth,
                'address' => $row->address,
                'roleId' => $row->role_id,
                'roleName' => $row->role_name,
            ];
        }, $dbResult);
    }
    /**
     * @param int $branchId ID of the branch for which to create the staff
     * @param array $details [
     * fullName: string,
     * dateOfBirth: string,
     * phoneNumber: string,
     * address: string,
     * roleId: int
     * ]
     * @return int ID of the created staff user
     */
    public function createStaffAtBranch($branchId, $details): int {
        $userId = DB::table('users')->insertGetId([
            'password' => Hash::make(''),
            'user_type' => 'staff'
        ]);

        DB::table('users')->where('id', '=', $userId)->update([
            'password' => Hash::make('S' . ((string)$userId))
        ]);

        DB::table('staff')->insert([
            'user_id' => $userId,
            'name' => $details['fullName'],
            'branch_id' => $branchId,
            'date_of_birth' => $details['dateOfBirth'],
            'phone_number' => $details['phoneNumber'],
            'address' => $details['address'],
            'role_id' => $details['roleId'],
        ]);
        
        return $userId;
    }
    /**
     * @param array $details [
     * fullName: string,
     * dateOfBirth: string,
     * phoneNumber: string,
     * address: string,
     * roleId: int
     * ]
     */
    public function editStaffDetails($id, $details) {
        DB::table('staff')
            ->where('user_id', '=', $id)    
            ->update([
                'name' => $details['fullName'],
                'date_of_birth' => $details['dateOfBirth'],
                'phone_number' => $details['phoneNumber'],
                'address' => $details['address'],
                'role_id' => $details['roleId']
            ]);
    }
}