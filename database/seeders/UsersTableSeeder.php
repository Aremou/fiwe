<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Saobane IDRIZ',
            'phone' => '67929780',
            'email' => 'saobaneidriz@gmail.com',
            'role' => 'admin',
            'is_active' => 1,
            'password' => Hash::make('fiwe229'),
        ]);
    }
}
