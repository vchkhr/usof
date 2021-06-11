<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('profiles')->insert([
                'user_id' => $i,
                'created_at' => '2000-01-01 00:00:01',
                'updated_at' => '2000-01-01 00:00:01'
            ]);
        }
    }
}
