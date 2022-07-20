<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'tweet',
    ];
    
    /**
     * ツイートに対するコメントの取得
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
