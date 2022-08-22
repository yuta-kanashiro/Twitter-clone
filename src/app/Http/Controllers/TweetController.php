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
     * @return Tweet
     */
    public function store(TweetRequest $request): Tweet
    {
        return $this->tweet->createTweet($request);
    }

    /**
     * ツイート削除
     *
     * @param int $tweetId
    //  * @return 
     */
    public function destroy(int $tweetId)
    {
        $tweet = $this->tweet->where('id', $tweetId)->first();
        $this->authorize('destroy', $tweet);

        return $this->tweet->deleteTweet($tweetId);

    }
}
