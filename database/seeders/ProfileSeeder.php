<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        DB::table('profiles')->insert([
            'user_id' => 1,
            'real_name' => 'Paul',
            'description' => 'Hi! I\'m a new here.',
            'url' => 'https://paul.com',
            'created_at' => '2000-01-01 00:00:01',
            'updated_at' => '2000-01-01 00:00:01'
        ]);

        DB::table('profiles')->insert([
            'user_id' => 2,
            'url' => 'http://ivan.com',
            'created_at' => '2000-01-01 00:00:01',
            'updated_at' => '2000-01-01 00:00:01'
        ]);

        for ($i = 3; $i <= 6; $i++) {
            DB::table('profiles')->insert([
                'user_id' => $i,
                'created_at' => '2000-01-01 00:00:01',
                'updated_at' => '2000-01-01 00:00:01'
            ]);
        }
    }
}
