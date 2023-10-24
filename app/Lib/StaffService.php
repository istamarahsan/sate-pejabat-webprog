<?php

namespace App\Lib;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffService
{
    /**
     * @return array [
     * id: int, 
     * name: string
     * ][]
     */
    public function getStaffRoles(): array
    {
        $dbResult = DB::table('staff_roles')
            ->select(['id', 'name'])
            ->get()
            ->toArray();
        return array_map(function ($e) {
            return [
                'id' => $e->id,
                'name' => $e->name
            ];
        }, $dbResult);
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
    public function getStaff(): array
    {
        $dbResult = DB::table('staff')
            ->selectRaw('staff.user_id AS id, staff.name, staff.phone_number, staff.date_of_birth, staff.address, staff_roles.id AS role_id, staff_roles.name AS role_name')
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
     * @param int $id
     * @return array [
     * id: int, 
     * name: string, 
     * phoneNumber: string,
     * dateOfBirth: string,
     * address: string,
     * roleId: int,
     * roleName: string
     * ]
     */
    public function getStaffById($id): array
    {
        $row = DB::table('staff')
            ->selectRaw('staff.user_id AS id, staff.name, staff.phone_number, staff.date_of_birth, staff.address, staff_roles.id AS role_id, staff_roles.name AS role_name')
            ->where('user_id', '=', $id)
            ->join('staff_roles', 'staff.role_id', '=', 'staff_roles.id')
            ->first();
        return [
            'id' => $row->id,
            'name' => $row->name,
            'phoneNumber' => $row->phone_number,
            'dateOfBirth' => $row->date_of_birth,
            'address' => $row->address,
            'roleId' => $row->role_id,
            'roleName' => $row->role_name,
        ];
    }

    /**
     * @param array $details [
     * fullName: string,
     * dateOfBirth: string,
     * phoneNumber: string,
     * address: string,
     * roleId: int
     * ]
     * @return int ID of the created staff user
     */
    public function createStaff($details): int
    {
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
    public function editStaffDetails($id, $details)
    {
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

    /**
     * @param int $id
     */
    public function deleteStaffMember(int $id)
    {
        DB::table('staff')
            ->where('user_id', '=', $id)
            ->delete();
    }
}
