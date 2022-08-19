<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * あるツイートとそのユーザーの取得
     *  */
    public function getTweet($id)
    {
        return $this->with('user')->find($id);
    }

    /**
     * ある掲示板をいいねしているユーザーのIDを取得
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'tweet_id', 'user_id')->withTimestamps();
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
