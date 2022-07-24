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
     * ツイートに対するコメントの取得
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
