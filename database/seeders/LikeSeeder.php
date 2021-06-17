<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class LikeSeeder extends Seeder
{
    public function run()
    {
        for ($i = 2; $i <= 5; $i++) {
            DB::table('likes')->insert([
                'user_id' => $i,
                'question_id' => 1,
                'answer_id' => null,
                'is_like' => 1,
                'created_at' => '2021-06-10 00:00:01',
                'updated_at' => '2021-06-10 00:00:01'
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            if ($i == 3) {
                continue;
            }

            DB::table('likes')->insert([
                'user_id' => $i,
                'question_id' => null,
                'answer_id' => 3,
                'is_like' => 0,
                'created_at' => '2021-06-10 00:00:01',
                'updated_at' => '2021-06-10 00:00:01'
            ]);
        }

        DB::table('likes')->insert([
            'user_id' => 2,
            'question_id' => 6,
            'answer_id' => null,
            'is_like' => 1,
            'created_at' => '2021-06-10 00:00:01',
            'updated_at' => '2021-06-10 00:00:01'
        ]);
    }
}
