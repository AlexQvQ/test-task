<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ru_RU');

        DB::table('products')->truncate();

        $groupIds = DB::table('groups')->pluck('id')->toArray();

        if (empty($groupIds)) {
            $this->call(GroupSeeder::class);
            $groupIds = DB::table('groups')->pluck('id')->toArray();
        }

        $products = [];
        for ($i = 1; $i <= 50; $i++) {
            $products[] = [
                'id_group' => $faker->randomElement($groupIds),
                'name' => $faker->unique()->words(2, true),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('products')->insert($products);
    }
}
