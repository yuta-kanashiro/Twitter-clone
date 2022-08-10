<?php

namespace App\UseCase\Tweet;

use App\Models\Tweet;

final class GetUserTweetUseCase
{
    /**
    * あるユーザーのツイートを全て取得
    * 
    * @param int $id
    * @return object
    */
    public function show(int $id)
    {
        // ユーザーのIDとツイートのuser_idが一致するものを投稿日時が新しい順（降順）に取得
        $tweets = Tweet::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        return $tweets;
    }
}
