<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medias')->insert([
            'filename' => 'https://cdn.pixabay.com/photo/2022/05/05/14/57/rice-7176354__340.jpg',
            'mimetype' => 'image/jpg',
            'is_active' => 1,
        ]);
    }
}
