<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'latitude' => 6.25056,
            'longitude' => 1.67528,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.32664,
            'longitude' => 1.83609,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.32722,
            'longitude' => 1.83607,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.32814,
            'longitude' => 1.83616,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.3278,
            'longitude' => 1.83627,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.32646,
            'longitude' => 1.83575,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.25547,
            'longitude' => 1.68066,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.24627,
            'longitude' => 1.67046,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.24707,
            'longitude' => 1.67161,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.25038,
            'longitude' => 1.68134,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.27365,
            'longitude' => 1.8039,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.27903,
            'longitude' => 1.8261,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.27428,
            'longitude' => 1.80628,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.27071,
            'longitude' => 1.78593,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.27673,
            'longitude' => 1.8178,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('geolocations')->insert([
            'latitude' => 6.28055,
            'longitude' => 1.838,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // DB::table('geolocations')->insert([
        //     'latitude' => ,
        //     'longitude' => ,
        // ]);
    }
}
