<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TouristExperiencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tourist_experiences')->insert([
            'label' => '{"fr":"DAKOUIN"}',
            'description' => '{"fr":"Dans l\' ambiance d’une cuisine traditionnelle béninoise (à ciel ouvert), apprenez à concocter un délicieux plat : Le Dakoin. La recette consiste en un mélange original de pâte de farine de manioc et de poisson frais. Laissez vos papilles gustatives frémir au goût du fameux Dakoin !"}',
            'city' => 'Grand-Popo',
            'unit_price' => 10000,
            'image_id' => 15,
            'video_id' => null,
            'geolocation_id' => 15,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('tourist_experiences')->insert([
            'label' => '{"fr":"HUILE DE COCO"}',
            'description' => '{"fr":"Le coco et Grand-Popo, vous l’aurez compris c’est une grande histoire d’amour. Les cocotiers à perte de vue en témoignent. La coopérative APECD a pour vision de valoriser les activités socio-économiques du village de Gbekon. Elle produit des litres d’huile de coco pressés à chaud ou à froid chaque année. Vivre une expérience touristique c’est aussi contribuer à sa façon aux activités génératrices de revenus du village qu’on découvre. Et c’est pour cette raison que vous prenez la bonne décision en choisissant cette expérience."}',
            'city' => 'Grand-Popo',
            'unit_price' => 10000,
            'image_id' => 16,
            'video_id' => null,
            'geolocation_id' => 16,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('tourist_experiences')->insert([
            'label' => '{"fr":"PËCHE"}',
            'description' => '{"fr":"La rencontre du euve mono et de l’océan atlantique, crée des conditions favorables à la pêche qui se pratique depuis des décennies à la bouche du Roy. Après avoir étudié les rudiments de la fabrication des lets de pêche avec l’épervier du village, allez à la pêche aux poissons et devenez un expert en la matière !"}',
            'city' => 'Grand-Popo',
            'unit_price' => 10000,
            'image_id' => 17,
            'video_id' => null,
            'geolocation_id' => 16,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('tourist_experiences')->insert([
            'label' => '{"fr":"TRESS\'ART"}',
            'description' => '{"fr":"Partez dans les tréfonds de Grand-Popo à la découverte des vannières de Tokpa-Aizo. Dans ce paysage dénudé de toute super cialité, vous rencontrerez des femmes animées d’une ambition noble, unies par l’amour du travail et de leur communauté. Elles vous parleront d’elles et vous passerez un moment mémorable en leur compagnie."}',
            'city' => 'Grand-Popo',
            'unit_price' => 10000,
            'image_id' => 18,
            'video_id' => null,
            'geolocation_id' => 16,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // DB::table('tourist_experiences')->insert([
        //     'label' => '{"fr":""}',
        //     'description' => '{"fr":""}',
        //     'city' => '',
        //     'unit_price' => 10000,
        //     'image_id' => ,
        //     'video_id' => null,
        //     'geolocation_id' => ,
        //     'is_active' => 1,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
    }
}
