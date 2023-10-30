<?php

namespace App\Lib;

enum ProductCategory: string
{
    case Food = "food";
    case Beverage = "beverage";
    case Snack = "snack";
    case Other = "other";

    public function toString(): string
    {
        switch ($this) {
            case ProductCategory::Food:
                return 'Food';
            case ProductCategory::Beverage:
                return 'Beverage';
            case ProductCategory::Snack:
                return 'Snack';
            case ProductCategory::Other:
                return 'Other';
        }
    }

    /**
     * @return ProductCategory[]
     */
    public static function values(): array
    {
        return [
            ProductCategory::Food,
            ProductCategory::Beverage,
            ProductCategory::Snack,
            ProductCategory::Other
        ];
    }

    public static function parse(string $in): ProductCategory | null
    {
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
