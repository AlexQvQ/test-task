<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GroupSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ru_RU');

        DB::table('groups')->truncate();

        $rootGroups = [];
        for ($i = 1; $i <= 5; $i++) {
            $rootGroups[] = [
                'name' => $faker->unique()->word . ' Group',
                'parent_id' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('groups')->insert($rootGroups);

        $level2Groups = [];
        $rootGroupIds = DB::table('groups')->where('parent_id', 0)->pluck('id');

        foreach ($rootGroupIds as $parentId) {
            for ($j = 1; $j <= rand(2, 4); $j++) {
                $level2Groups[] = [
                    'name' => $faker->unique()->word . ' Subgroup',
                    'parent_id' => $parentId,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        DB::table('groups')->insert($level2Groups);

        $level2GroupIds = DB::table('groups')->whereIn('parent_id', $rootGroupIds)->pluck('id');

        foreach ($level2GroupIds as $parentId) {
            if ($faker->boolean(50)) {
                DB::table('groups')->insert([
                    'name' => $faker->unique()->word . ' Division',
                    'parent_id' => $parentId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
