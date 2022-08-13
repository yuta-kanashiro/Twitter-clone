<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    /**
     * ユーザーが投稿したツイートの取得
     */
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    /**
     * ユーザーが投稿したコメントの取得
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

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
    * @return object
    */
    public function getUserInfo(int $id): object
    {
        return $this->with('tweets')->find($id);
    }
}
