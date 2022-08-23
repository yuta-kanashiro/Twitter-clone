<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller
{
    /**
    * フォロー済みかチェック（フォローしていればtrue,フォローしていなければfalseを返す）
    *
    * @param  int $followUserId
    * @return bool
    */
    public function isFollowing(int $followUserId): bool
    {
        $loginUser = User::find(auth()->id());

        $isFollowing = $loginUser->isFollowing($followUserId);
        $isMyself = $loginUser->id === $followUserId;
        $response = $isFollowing && !$isMyself;

        return $response;
    }

    /**
    * フォローする/外す
    * 
    * @param int $followUserId
    */
    public function followAction(int $followUserId)
    {
        $loginUser = User::find(auth()->id());

        if (!$this->isFollowing($followUserId)) {
            $loginUser->follow($followUserId);
        } else {
            $loginUser->unfollow($followUserId);
        }
    }

    /**
    * フォローリスト
    * 
    * @param int $userId
    * @return array
    */
    public function getFollowList(int $userId): array
    {
        $user = User::find($userId);

        return $user->getFollowList($userId);
    }
}
