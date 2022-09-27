<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestCenterCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interest_center_categories')->insert([
            'label' => '{"fr":"Espace publique"}',
        ]);
        DB::table('interest_center_categories')->insert([
            'label' => '{"fr":"Monuments nationaux"}',
        ]);
        DB::table('interest_center_categories')->insert([
            'label' => '{"fr":"\\u00c9glise"}',
        ]);
        DB::table('interest_center_categories')->insert([
            'label' => '{"fr":"Restauration"}',
        ]);
    }
}
