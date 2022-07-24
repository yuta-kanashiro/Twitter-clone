<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            [
                'account_name' => 'sample1',
                'user_name' => 'sample1sample1',
                'email' => 'sample1@sample.com',
                'password' => bcrypt('sample1sample1'),
                'introduction' => 'みなさんこんにちは。僕の名前はsample1です。この文章は自己紹介のサンプルです。',
                'profile_image' => null,
                'remember_token' => Str::random(10),
            ],
        ]);

        User::factory()->count(50)->create(); 
    }
}
