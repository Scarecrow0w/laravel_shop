<?php

namespace App\Http\Controllers\Products;

use App\Domain\Product\Product;
use App\Models\City;
use App\Models\ProductCategory;
use App\Traits\Filterable;

class ProductIndexController
{
    use Filterable;

    public function __invoke()
    {
        $products = Product::query();

        $cities = City::all();
        $product_categories = ProductCategory::all();

        $products = $this->filterProduct($products, request());
        $products = $products->paginate();

        return view('products.index', compact('products', 'cities', 'product_categories'));
    }
}
