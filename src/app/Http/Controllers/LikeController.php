<?php

namespace App\Http\Controllers;

use App\Models\User;

class LikeController extends Controller
{
    /**
    * いいね済みかチェック（フォローしていればtrue,フォローしていなければfalseを返す）
    *
    * @param int $likeTweetId
    * @return bool
    */
    public function isLike(int $likeTweetId): bool
    {
        $loginUser = User::find(auth()->id());

        $likeExists = $loginUser->isLike($likeTweetId);

        return $likeExists;
    }

    // /**
    // * いいねする
    // * 
    // * @param int $likeTweetId
    // */
    // public function like(int $likeTweetId)
    // {
    //     $loginUser = User::find(auth()->id());

    //     if(!$this->isLike($likeTweetId)){
    //         $loginUser->like($likeTweetId);
    //     }
    // }

    // /**
    // * いいねを外す
    // * 
    // * @param int $likeTweetId
    // */
    // public function unlike(int $likeTweetId)
    // {
    //     $loginUser = User::find(auth()->id());

    //     if($this->isLike($likeTweetId)){
    //         $loginUser->unlike($likeTweetId);
    //     }
    // }

    /**
    * いいねをする/外す
    * 
    * @param int $likeTweetId
    */
    public function likeAction(int $likeTweetId)
    {
        $loginUser = User::find(auth()->id());

        if(!$this->isLike($likeTweetId)){
            $loginUser->like($likeTweetId);
        }else{
            $loginUser->unlike($likeTweetId);
        }
    }
}
