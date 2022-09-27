<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeolocalisationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('geolocations')->insert([
            'latitude' => 6.362334735516658,
            'longitude' => 2.414018969108942,
        ]);
    }
}
