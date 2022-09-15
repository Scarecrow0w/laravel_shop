<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\ProductProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories_count = ProductCategory::count();

        DB::table('products')->orderBy('id')->chunk(200, function ($products) use ($categories_count) {
            foreach ($products as $product) {
                $rand = rand(1, $categories_count);

                $product_category_id = [];

                for ($k = 1; $k <= $rand; $k++) {
                    $product_category_id[] = [
                        'product_id' => $product->id,
                        'product_category_id' => $k,
                    ];
                }

                ProductProductCategory::insert($product_category_id);
            }
        });
    }
}
