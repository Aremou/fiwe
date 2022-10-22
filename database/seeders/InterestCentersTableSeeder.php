<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'label' => '{"fr":"Place AGBOLOU"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 1,
            'geolocation_id' => 1,
            'image_id' => 1,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Entrepôt Colonial"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 1,
            'geolocation_id' => 2,
            'image_id' => 2,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Tombe coloniale du Caporal ANANI Bernard"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 1,
            'geolocation_id' => 3,
            'image_id' => 3,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Centre de Santé"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 2,
            'geolocation_id' => 4,
            'image_id' => 4,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Ancien puits Colonial"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 1,
            'geolocation_id' => 5,
            'image_id' => 5,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Marché Colonial"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 1,
            'geolocation_id' => 6,
            'image_id' => 6,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Embarcadères Marché Djora"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 3,
            'geolocation_id' => 7,
            'image_id' => 7,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Centre de Santé d’Agoué"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 2,
            'geolocation_id' => 8,
            'image_id' => 8,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"ARRONDISSEMENT d’Agoué"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 2,
            'geolocation_id' => 9,
            'image_id' => 9,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Mosquée Centrale d’Agoué"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 1,
            'geolocation_id' => 10,
            'image_id' => 10,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Ganna Hotel"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 4,
            'geolocation_id' => 11,
            'image_id' => 11,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Centre NONVIGNON"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 4,
            'geolocation_id' => 12,
            'image_id' => 12,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Bar Restaurant Coco Beach"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 4,
            'geolocation_id' => 13,
            'image_id' => 13,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('interest_centers')->insert([
            'label' => '{"fr":"Bar Restaurant chez Tata Cléclé"}',
            'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
            'user_id' => 1,
            'interest_center_category_id' => 5,
            'geolocation_id' => 14,
            'image_id' => 14,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // DB::table('interest_centers')->insert([
        //     'label' => '{"fr":""}',
        //     'description' => '{"fr":"La Place Bulgarie est une place publique situ\\u00e9e \\u00e0 Gb\\u00e9gamey dans le 11e arrondissement de Cotonou o\\u00f9 est \\u00e9rig\\u00e9e la statue de Georgi Dimitrov, communiste bulgare 1. Cette place est construite pour t\\u00e9moigner le pass\\u00e9 marxiste l\\u00e9niniste du B\\u00e9nin sous le r\\u00e8gne du g\\u00e9n\\u00e9ral Mathieu K\\u00e9r\\u00e9kou gouvern\\u00e9 par le Parti de la r\\u00e9volution populaire du B\\u00e9nin avant de passer de la r\\u00e9publique populaire du B\\u00e9nin lors de la conf\\u00e9rence nationale des forces vives de la nation de f\\u00e9vrier 1990. il est plus connu au sous le vocable Papa Bulgarie ou vieux bulgare."}',
        //     'user_id' => 1,
        //     'interest_center_category_id' => ,
        //     'geolocation_id' => ,
        //     'image_id' => null,
        //     'is_active' => 1,
        // ]);
    }
}
