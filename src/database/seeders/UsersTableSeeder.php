<?php

namespace Database\Seeders;

use App\Http\Controllers\FollowController;
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
            // Userモデルからランダムで1~15件取得
            $followerUsers = User::inRandomOrder()->take(rand(1, 15))->get();

            foreach($followerUsers as $followerUser){
                $existing = $followingUser->followCheck($followerUser->id);
                $myself = $followingUser->id === $followerUser->id;

                // フォロー済みではない、かつフォロー相手がユーザ自身ではない場合、フォロー
                if (!$existing && !$myself){
                    $followingUser->follow($followerUser->id);
                }
            }
        }
    }
}
