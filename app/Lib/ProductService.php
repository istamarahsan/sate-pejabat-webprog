<?php

namespace App\Lib;

use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * @param int $id ID of the product
     * @return array [
     * id: int, 
     * name: string,
     * category: ProductCategory,
     * price: float
     * ]
     */
    public function getProduct($id): array | null
    {
        $dbResult = DB::table('products')->select(['id', 'name', 'price', 'category'])->where('id', '=', $id)->get();
        if (count($dbResult) != 1) {
            return null;
        }
        return $this->parseModel($dbResult->first());
    }

    /**
     * @return array [ 
     * id: int, 
     * name: string,
     * category: ProductCategory,
     * price: float
     * ][]
     */
    public function getAllProducts(): array
    {
        $dbResult = DB::table('products')->select(['id', 'name', 'price', 'category'])->get()->toArray();
        return array_map(fn ($e) => $this->parseModel($e), $dbResult);
    }

    /**
     * @param array $details [
     * name: string,
     * category: ProductCategory,
     * price: float
     * ]
     * @return array [
     * id: int, 
     * name: string,
     * category: ProductCategory,
     * price: float
     * ]
     */
    public function createProduct(array $details): array
    {
        $id = DB::table('products')->insertGetId([
            'name' => $details['name'],
            'price' => $details['price'],
            'category' => strtoupper($details['category']->toString())
        ]);
        return DB::table('products')
            ->select(['id', 'name', 'category', 'price'])
            ->where('id', '=', $id)
            ->get()
            ->map(fn ($e) => $this->parseModel($e))
            ->first();
    }

    /**
     * @param int $id
     * @param array $details [
     * name: string,
     * category: ProductCategory,
     * price: float
     * ]
     * @return array [
     * id: int, 
     * name: string,
     * category: ProductCategory,
     * price: float
     * ]
     */
    public function updateProduct(int $id, array $details): array
    {
        DB::table('products')
            ->where('id', '=', $id)
            ->update([
                'name' => $details['name'],
                'category' => strtoupper($details['category']->toString()),
                'price' => $details['price']
            ]);
        return DB::table('products')
            ->select(['id', 'name', 'category', 'price'])
            ->where('id', '=', $id)
            ->get()
            ->map(fn ($e) => $this->parseModel($e))
            ->first();
    }

    /**
     * @param int $id
     */
    public function deleteProduct(int $id)
    {
        DB::table('products')
            ->where('id', '=', $id)
            ->delete();
    }

    private function parseModel($obj): array
    {
        return [
            'id' => $obj->id,
            'name' => $obj->name,
            'price' => floatval($obj->price),
            'category' => ProductCategory::parse($obj->category)
        ];
    }
}
