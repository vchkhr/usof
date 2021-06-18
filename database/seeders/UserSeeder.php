<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'pavlo',
            'email' => 'pavlo@gmail.com',
            'password' => Hash::make('qweqweqwe'),
            'is_admin' => true,
            'created_at' => '2021-06-01 00:00:01',
            'updated_at' => '2021-06-01 00:00:01',
            'email_verified_at' => '2021-06-01 00:00:01',
        ]);
        
        DB::table('users')->insert([
            'name' => 'ivan',
            'email' => 'ivan@gmail.com',
            'password' => Hash::make('qweqweqwe'),
            'created_at' => '2021-06-02 00:00:01',
            'updated_at' => '2021-06-02 00:00:01',
            'email_verified_at' => '2021-06-02 00:00:01',
        ]);
        
        DB::table('users')->insert([
            'name' => 'kateryna',
            'email' => 'kateryna@gmail.com',
            'password' => Hash::make('qweqweqwe'),
            'created_at' => '2021-06-03 00:00:01',
            'updated_at' => '2021-06-03 00:00:01',
            'email_verified_at' => '2021-06-03 00:00:01',
        ]);
        
        DB::table('users')->insert([
            'name' => 'olya',
            'email' => 'olya@gmail.com',
            'password' => Hash::make('qweqweqwe'),
            'created_at' => '2021-06-04 00:00:01',
            'updated_at' => '2021-06-04 00:00:01',
            'email_verified_at' => '2021-06-04 00:00:01',
        ]);
        
        DB::table('users')->insert([
            'name' => 'nazar',
            'email' => 'nazar@gmail.com',
            'password' => Hash::make('qweqweqwe'),
            'created_at' => '2021-06-05 00:00:01',
            'updated_at' => '2021-06-05 00:00:01',
            'email_verified_at' => '2021-06-05 00:00:01',
        ]);
        
        DB::table('users')->insert([
            'name' => 'jack',
            'email' => 'jack@gmail.com',
            'password' => Hash::make('qweqweqwe'),
            'created_at' => '2021-06-06 00:00:01',
            'updated_at' => '2021-06-06 00:00:01',
            'email_verified_at' => '2021-06-06 00:00:01',
        ]);
    }
}
