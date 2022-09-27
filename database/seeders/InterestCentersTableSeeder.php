<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestCentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Place Bulgarie"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 1,
            'geolocation_id' => 1,
            'image_id' => 1,
            'is_active' => 1,
        ]);
    }
}
