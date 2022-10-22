<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(GeolocalisationsTableSeeder::class);
        $this->call(MediasTableSeeder::class);
        $this->call(InterestCenterCategoriesTableSeeder::class);
        $this->call(InterestCentersTableSeeder::class);
        $this->call(TouristExperiencesTableSeeder::class);
    }
}
