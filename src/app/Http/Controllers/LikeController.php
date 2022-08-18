<?php

namespace App\Http\Controllers;

use App\Models\User;

class LikeController extends Controller
{
    /**
    * いいね済みかチェック（フォローしていればtrue,フォローしていなければfalseを返す）
    *
    * @param  int $likeTweetId
    * @return 
    */
    public function isLike(int $likeTweetId)
    {
        $loginUser = User::find(auth()->id());

        $likeExists = $loginUser->isLike($likeTweetId);

        if ($likeExists){
            return true;
        }elseif(!$likeExists){
            return false;
        }
    }

    /**
    * いいねする
    * 
    * @param  int $likeTweetId
    */
    public function like(int $likeTweetId)
    {
        $loginUser = User::find(auth()->id());

        if(!$this->isLike($likeTweetId)){
            $loginUser->like($likeTweetId);
        }
    }

    /**
    * フォローを外す
    * 
    * @param  int $likeTweetId
    */
    public function unlike(int $likeTweetId)
    {
        $loginUser = User::find(auth()->id());

        if($this->isLike($likeTweetId)){
            $loginUser->unlike($likeTweetId);
        }
    }
}
