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
     * @param int $tweetId
     * @return array
     */
    public function show(int $tweetId): array
    {
        $tweet = $this->tweet->getTweet($tweetId);
        
        return [
            'tweet' => $tweet,
            'countLikes' => $tweet->countLikes()
        ];
    }
}
