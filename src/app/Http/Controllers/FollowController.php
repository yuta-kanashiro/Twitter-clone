<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller
{
    /**
    * フォロー済みかチェック（フォローしていればtrue,フォローしていなければfalseを返す）
    *
    * @param  int $followUserId
    * @return int
    */
    public function followCheck(int $followUserId): int
    {
        $loginUser = User::find(auth()->id());

        $existing = $loginUser->followCheck($followUserId);
        $myself = $loginUser->id === $followUserId;

        if ($existing && !$myself){
            return 1;
        }elseif(!$existing && !$myself){
            return 0;
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

        if(!$this->followCheck($followUserId)){
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

        if($this->followCheck($followUserId)){
            $loginUser->unfollow($followUserId);
        }
    }
}
