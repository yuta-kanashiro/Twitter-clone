<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller
{
    /**
    * フォロー済みかチェック（フォローしていれば1,フォローしていなければ0を返す）
    *
    * @param  int $followUserId
    * @return bool
    */
    public function isFollowing(int $followUserId): bool
    {
        $loginUser = User::find(auth()->id());

        $followingExists = $loginUser->isFollowing($followUserId);
        $isMyself = $loginUser->id === $followUserId;

        if ($followingExists && !$isMyself){
            return true;
        }elseif(!$followingExists && !$isMyself){
            return false;
        }elseif($isMyself){
            return false;
        }
    }

    /**
    * フォローする
    * 
    * @param  int $followUserId
    */
    public function follow(int $followUserId)
    {
        $loginUser = User::find(auth()->id());

        if(!$this->isFollowing($followUserId)){
            $loginUser->follow($followUserId);
        }
    }

    /**
    * フォローを外す
    * 
    * @param  int $followUserId
    */
    public function unfollow(int $followUserId)
    {
        $loginUser = User::find(auth()->id());

        if($this->isFollowing($followUserId)){
            $loginUser->unfollow($followUserId);
        }
    }
}
