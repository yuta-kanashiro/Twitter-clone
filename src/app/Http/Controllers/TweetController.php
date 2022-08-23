<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;

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
        return $this->tweet->getTweet($tweetId);
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
     * ツイート投稿
     *
     * @param TweetRequest $request
     */
    public function store(TweetRequest $request)
    {
        $this->tweet->createTweet($request);
    }

    /**
     * ツイート削除
     *
     * @param int $tweetId
     */
    public function destroy(int $tweetId)
    {
        $this->tweet->deleteTweet($tweetId);
    }
}
