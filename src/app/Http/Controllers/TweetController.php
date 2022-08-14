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
     * @return object
     */
    public function show(int $id): object
    {
        return $this->tweet->getTweet($id);
    }
}
