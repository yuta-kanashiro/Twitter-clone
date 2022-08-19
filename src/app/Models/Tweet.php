<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text',
    ];
    
    /**
     * ツイートを保持するユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ツイートに対するコメントの取得
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * ある掲示板をいいねしているユーザーのIDを取得
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'tweet_id', 'user_id')->withTimestamps();
    }

    /**
     * あるツイートとそのユーザーの取得
     * 
     * @return object
     */
    public function getTweet($id): object
    {
        return $this->with('user')->find($id);
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

        return [
            'tweets' => $tweets,
            'followingExists' => $loginUser->countFollowings()
        ];
    }

    /**
     * ツイートの投稿
     * 
     * @param $request
     * @return object
     */
    public function createTweet($request): object
    {
        $this->user_id = auth()->id();
        $this->text = $request->text;
        $this->save();

        return $this;
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
