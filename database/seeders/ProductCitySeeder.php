<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\ProductCity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities_count = City::count();

        DB::table('products')->orderBy('id')->chunk(200, function ($products) use ($cities_count) {
            foreach ($products as $product) {
                $rand = rand(1, $cities_count);
                $product_city_id = [];

                for ($i = 1; $i <= $rand; $i++) {
                    $product_city_id[] = [
                        'product_id' => $product->id,
                        'city_id' => $i,
                    ];
                }

                ProductCity::insert($product_city_id);
            }
        });
    }
}
