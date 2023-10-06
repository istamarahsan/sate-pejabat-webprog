<?php

namespace App\Lib;

use Illuminate\Support\Facades\DB;

class ProductService {
    /**
     * @param int $id ID of the product
     * @return array [
     * id: int, 
     * name: string,
     * category: ProductCategory,
     * price: int
     * ]
     */
    public function getProduct($id): array | null {
        $dbResult = DB::table('products')->select(['id', 'name', 'price', 'category'])->where('id', '=', $id)->get(); 
        if (count($dbResult) != 1) {
            return null;
        }
        return $this->parseModel($dbResult);
    }

    /**
     * @return array [ 
     * id: int, 
     * name: string,
     * category: ProductCategory,
     * price: int
     * ][]
     */
    public function getAllProducts(): array {
        $dbResult = DB::table('products')->select(['id', 'name', 'price', 'category'])->get()->toArray();
        return array_map(fn($e) => $this->parseModel($e), $dbResult);
    }

    private function parseModel($obj) : array {
        return [
            'id' => $obj->id,
            'name' => $obj->name,
            'price' => floatval($obj->price),
            'category' => $this->parseProductCategory($obj->category)
        ];
    }

    private function parseProductCategory($in) {
        switch (strtolower($in)) {
            case 'food':
                return ProductCategory::Food;
            case 'beverage':
                return ProductCategory::Beverage;
            case 'snack':
                return ProductCategory::Snack;
            case 'other':
                return ProductCategory::Other;
            default:
                return null;
        }
    }
}