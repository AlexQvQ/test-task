<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Faker\Factory as Faker;

class PriceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ru_RU');

        $products = Product::all();

        if ($products->isEmpty()) {
            Product::factory(10)->create();
            $products = Product::all();
        }

        foreach ($products as $product) {
            DB::table('prices')->insert([
                'id_product' => $product->id,
                'price' => $faker->randomFloat(2, 10, 1000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
