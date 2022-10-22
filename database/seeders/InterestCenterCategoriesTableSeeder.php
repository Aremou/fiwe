<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'label' => '{"fr":"CURIOSITÉ LOCALE"}',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_center_categories')->insert([
            'label' => '{"fr":"COMMODITÉS"}',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_center_categories')->insert([
            'label' => '{"fr":"DIVERS"}',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_center_categories')->insert([
            'label' => '{"fr":"HOTEL / RESTAURATION"}',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_center_categories')->insert([
            'label' => '{"fr":"BAR / RESTAURATION"}',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // DB::table('interest_center_categories')->insert([
        //     'label' => '{"fr":""}',
        // ]);
    }
}
