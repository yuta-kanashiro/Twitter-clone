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
     * あるツイートを取得
     *  */
    public function getTweet($id)
    {
        return $this->find($id);
    }
}
