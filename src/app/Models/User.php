<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'account_name',
        'user_name',
        'email',
        'password',
        'profile_text',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    # リレーション
    public function tweets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Tweet::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function followings(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follow', 'following_id', 'follower_id')->withTimestamps();
    }

    public function followers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follow', 'follower_id', 'following_id')->withTimestamps();
    }

    public function likes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tweet::class, 'likes', 'user_id', 'tweet_id')->withTimestamps();
    }

    # ユーザーに関する処理
    /**
    * 全ユーザー情報の取得(ユーザー一覧画面)
    * 
    * @return Collection
    */
    public function getAllUsers(): Collection
    {
        return $this->orderBy('created_at', 'desc')->get();
    }

    /**
    * あるユーザー情報の取得（ユーザー詳細画面）
    *
    * @param int $id
    * @return User
    */
    public function getUserInfo(int $id): User
    {
        return $this->with('tweets')->find($id);
    }

    // # フォローに関する処理
    /**
     * フォロー判定
     * 
     * @param int $followUserId
     * @return bool
     */
    public function isFollowing(int $followUserId): bool
    {
        // フォロー対象のユーザID（$followUserId）が、すでにフォローしているfollower_idと重複していないかどうかを判定
        return $this->followings()->where('follower_id', $followUserId)->exists();
    }

    /**
     * フォロー処理
     * 
     * @param int $followUserId
     */
    public function follow(int $followUserId)
    {
        $this->followings()->attach($followUserId);
    }

    /**
     * フォローを外す処理
     * 
     * @param int $followUserId
     */
    public function unfollow(int $followUserId)
    {
        $this->followings()->detach($followUserId);
    }

    /**
    * フォローリスト
    * 
    * @param int $userId
    * @return array
    */
    public function getFollowList(int $userId): array
    {
        $user = $this->find($userId);

        $followingUsers = $user->whereIn('id', $user->followings()->pluck('follower_id'))->get();
        $followerUsers = $user->whereIn('id', $user->followers()->pluck('following_id'))->get();

        return [
            'followingUsers' => $followingUsers,
            'followerUsers' => $followerUsers
        ];
    }

    /**
     * フォロー数カウント
     * 
     * @return int
     */
    public function countFollowings(): int
    {
        return $this->followings()->count();
    }

    /**
     * フォロワー数カウント
     * 
     * @return int
     */
    public function countFollowers(): int
    {
        return $this->followers()->count();
    }

    # いいねに関する処理
    /**
     * いいね判定
     * 
     * @param int $likeTweetId
     * @return bool
     */
    public function isLike($likeTweetId): bool
    {
        //  いいね対象の掲示板ID（$likeTweetId）が、すでにいいねしているtweet_idと重複していないかどうかを判定
        return $this->likes()->where('tweet_id', $likeTweetId)->exists();
    }

    
    /**
     * いいね処理
     * 
     * @param int $likeTweetId
     */
    public function like($likeTweetId)
    {
        $this->likes()->attach($likeTweetId);
    }

    /**
     * いいねを外す処理
     * 
     * @param int $likeTweetId
     */
    public function unlike($likeTweetId)
    {
        $this->likes()->detach($likeTweetId);
    }

    /**
     * ツイートー数カウント
     * 
     * @return int
     */
    public function countTweets(): int
    {
        return $this->tweets()->count();
    }
}
