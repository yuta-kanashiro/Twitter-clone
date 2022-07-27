<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
    ];

    /**
     * コメントしているユーザーの取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * コメントを所有しているツイートの取得
     */
    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }
}
