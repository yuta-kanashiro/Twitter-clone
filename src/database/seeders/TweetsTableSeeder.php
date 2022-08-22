<?php

namespace Database\Seeders;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tweet::factory()->count(200)->create(); 

        // 中間テーブル（likeテーブル）のダミーデータ作成
        $likeUsers= User::all();

        foreach($likeUsers as $likeUser){
            // Bulletinモデルからランダムで1~8件取得
            $likeTweets = Tweet::inRandomOrder()->take(rand(0, 12))->get();

            foreach($likeTweets as $likeTweet){
                $likeExists = $likeUser->isLike($likeTweet->id);

                // いいね済みではない場合、いいねをする
                if (!$likeExists){
                    $likeUser->like($likeTweet->id);
                }
            }
        }
    }
}
