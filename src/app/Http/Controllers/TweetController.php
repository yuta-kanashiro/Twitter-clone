<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use Illuminate\Support\Collection;

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

    /**
    * 全ユーザー情報の取得
    * 
    * @return array
    */
    public function getTimeline(): array
    {
        return $this->tweet->getTimeline();
    }

    /**
     * あるツイートを取得
     *
     * @param TweetRequest $request
     * @return object
     */
    public function store(TweetRequest $request): object
    {
        return $this->tweet->createTweet($request);
    }
}
