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
                'profile_text' => 'みなさんこんにちは。僕の名前はsample1です。この文章は自己紹介のサンプルです。',
                'profile_image' => null,
                'remember_token' => Str::random(10),
            ],
        ]);

        User::factory()->count(50)->create(); 

        // 中間テーブル（followテーブル）のダミーデータ作成
        $followingUsers = User::all();

        foreach($followingUsers as $followingUser){
            // 1~20までの数値をランダムで取得
            $ran = rand(1, 20);
            // Userモデルからランダムで1~20件取得
            $followerUsers = User::inRandomOrder()->take($ran)->get();

            foreach($followerUsers as $followerUser){
                // すでにフォロー済みではないか？
                $existing = $followingUser->isFollowing($followerUser->id);
                // フォローする相手がユーザ自身ではないか？
                $myself = $followingUser->id === $followerUser->id;

                // フォロー済みではない、かつフォロー相手がユーザ自身ではない場合、フォロー
                if (!$existing && !$myself){
                    $followingUser->follow($followerUser->id);
                }
            }
        }
    }
}
