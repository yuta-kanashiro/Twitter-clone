<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text',
    ];
    
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'tweet_id', 'user_id')->withTimestamps();
    }

    /**
     * あるツイートとそのユーザーの取得
     * 
     * @param int $tweetId
     * @return array
     */
    public function getTweet(int $tweetId): array
    {
        $tweet = $this->with('user')->find($tweetId);

        return [
            'tweet' => $tweet,
            'loginUserId' => auth()->id(),
            'countLikes' => $tweet->countLikes()
        ];
    }

    /**
     * タイムラインの取得(フォローしているユーザーのツイートと自身のツイートを取得)
     * 
     * @return array
     */
    public function getTimeline(): array
    {
        $loginUser = $loginUser = User::find(auth()->id());

        $tweets = $this->whereIn('user_id', $loginUser->followings()->pluck('follower_id'))
                    ->orWhere('user_id', $loginUser->id)
                    ->orderBy('created_at', 'desc')
                    ->with('user')
                    ->get();

        if($tweets->isEmpty()){
            return [
                'tweetExists' => false
            ];
        }else{
            return [
                'tweets' => $tweets,
                'tweetExists' => true
            ];
        }
    }

    /**
     * ツイートの投稿
     * 
     * @param Request $request
     * @return Tweet
     */
    public function createTweet(Request $request): Tweet
    {
        $this->user_id = auth()->id();
        $this->text = $request->text;
        $this->save();

        return $this;
    }

    /**
     * ツイートの削除
     * 
     * @param int $tweetId
    //  * @return 
     */
    public function deleteTweet(int $tweetId)
    {
        return $this->where('id', $tweetId)->first()->delete();
    }

    /**
     * いいね数カウント
     * 
     * @return int
     */
    public function countLikes(): int
    {
        return $this->likes()->count();
    }
}
