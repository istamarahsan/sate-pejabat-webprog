<?php

namespace App\Lib;

use Illuminate\Support\Facades\DB;

class BranchService {
    /**
     * @param int $id ID of the branch
     * @return array [
     * id: int, 
     * name: string
     * ]
     */
    public function getBranch($id): array | null {
        $dbResult = DB::table('branches')->select(['id', 'name'])->where('id', '=', $id)->get(); 
        if (count($dbResult) != 1) {
            return null;
        }
        return get_object_vars($dbResult[0]);
    }

    /**
     * @return array [ 
     * 
     * ]
     */
    public function getAllBranches(): array {
        $dbResult = DB::table('branches')->select(['id', 'name'])->get()->toArray();
        return array_map(function($object) {return get_object_vars($object);}, $dbResult);
    }
}