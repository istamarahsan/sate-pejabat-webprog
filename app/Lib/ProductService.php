<?php

namespace App\Lib;

use Illuminate\Support\Facades\DB;

class ProductService {
    /**
     * @param int $id ID of the product
     * @return array [
     * id: int, 
     * name: string
     * price: int
     * ]
     */
    public function getProduct($id): array | null {
        $dbResult = DB::table('products')->select(['id', 'name', 'price'])->where('id', '=', $id)->get(); 
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
    public function getAllProducts(): array {
        $dbResult = DB::table('products')->select(['id', 'name', 'price'])->get()->toArray();
        return array_map(function($object) {return get_object_vars($object);}, $dbResult);
    }
}