<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * 
     *
     * @param Tweet $tweet
     */
    public function __construct(Tweet $tweet) {
        $this->tweet = $tweet;
    }

    /**
     * あるツイートを取得
     *
     * @param int $id
     * @return array
     */
    public function show(int $id): array
    {
        $tweet = $this->tweet->getTweet($id);
        
        return [
            'tweet' => $tweet,
            'countLikes' => $tweet->countLikes()
        ];
    }
}
