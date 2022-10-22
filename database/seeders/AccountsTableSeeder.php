<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'fullname' => 'John Doe',
            'birth_date' => '1996-01-15',
            'civility' => 'M',
            'birth_country' => 'Bénin',
            'profession' => 'Dev web',
            'experience_count' => 0,
            'certify' => 0,
            'user_id' => 1,
        ]);
    }
}
