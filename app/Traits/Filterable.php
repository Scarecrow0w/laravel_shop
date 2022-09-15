<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Filter product query
     *
     * @param  Builder $query
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filterProduct(Builder $query, \Illuminate\Http\Request $request): \Illuminate\Database\Eloquent\Builder
    {
        if ($query_city = $request->city) {
            $query->leftJoin('product_cities', 'products.id', '=', 'product_cities.product_id');

            $query = $query->whereIn('city_id', $query_city);
        }

        if ($query_category = $request->product_category) {
            $query->leftJoin('product_product_categories', 'products.id', '=', 'product_product_categories.product_id');

            $query = $query->where('product_category_id', '=', $query_category);
        }

        $query = $query->select([
            'id',
            'uuid',
            'name',
            'item_price',
            'vat_percentage',
            'manages_inventory',
            'created_at',
            'updated_at',
        ])->groupBy([
            'id',
            'uuid',
            'name',
            'item_price',
            'vat_percentage',
            'manages_inventory',
            'created_at',
            'updated_at',
        ]);

        return $query;
    }
}
